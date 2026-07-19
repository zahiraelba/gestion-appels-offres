<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Models\AppelOffre;
use App\Models\Offre;
use App\Models\User;

use App\Http\Controllers\AppelOffreController;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\RapportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OffreController;
use App\Http\Controllers\DocumentFournisseurController;
use App\Http\Controllers\AdminDocumentController;
use App\Http\Controllers\CommissionController;
use App\Http\Controllers\ResultatCommissionController;
Route::middleware('auth')->group(function () {

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    Route::get('/fournisseur/dashboard',
        [FournisseurController::class, 'dashboard'])
        ->name('fournisseur.dashboard');

    Route::get('/mes-offres',
        [FournisseurController::class, 'mesOffres'])
        ->name('mes.offres');

    Route::get('/mes-invitations',
        [FournisseurController::class, 'invitations'])
        ->name('mes.invitations');

    Route::get('/appels-offres',
        [FournisseurController::class, 'appels'])
        ->name('appels.index');
Route::get('/admin/rapports/export-excel', [RapportController::class, 'exportExcel'])
    ->name('rapports.export.excel');
    Route::delete('/admin/commission-participants/{participant}', 
    [CommissionController::class, 'deleteParticipant'])
    ->name('admin.commission-participants.destroy');
    Route::get('/offres/create/{id}', [OffreController::class, 'create'])
    ->name('offres.create');

    Route::post('/offres', [OffreController::class, 'store'])
    ->name('offres.store');
    Route::get('/offres/{id}/edit', [OffreController::class, 'edit'])->name('offres.edit');

Route::put('/offres/{id}', [OffreController::class, 'update'])->name('offres.update');
Route::delete('/offres/{id}', [OffreController::class, 'destroy'])->name('offres.destroy');
Route::patch('/invitations/{id}/accepter', [InvitationController::class, 'accepter'])
    ->name('invitations.accepter');

Route::patch('/invitations/{id}/refuser', [InvitationController::class, 'refuser'])
    ->name('invitations.refuser');
Route::get('/mes-documents', [DocumentFournisseurController::class, 'index'])
    ->name('documents.index');
Route::patch('/admin/documents/{document}/accepter', [AdminDocumentController::class, 'accepter'])
    ->name('admin.documents.accepter');
Route::patch('/admin/documents/{document}/refuser', [AdminDocumentController::class, 'refuser'])
    ->name('admin.documents.refuser');
Route::post('/mes-documents', [DocumentFournisseurController::class, 'store'])
    ->name('documents.store');
Route::get('/admin/commissions/create/{appelOffre}',
    [CommissionController::class, 'create'])
    ->name('admin.commissions.create');
Route::get('/admin/commissions', [CommissionController::class, 'index'])
    ->name('admin.commissions.index');
Route::post('/admin/commissions',
    [CommissionController::class, 'store'])
    ->name('commissions.store');
    Route::get('/admin/commissions/{commission}/edit', [CommissionController::class, 'edit'])
    ->name('admin.commissions.edit');

Route::put('/admin/commissions/{commission}', [CommissionController::class, 'update'])
    ->name('admin.commissions.update');

Route::delete('/admin/commissions/{commission}', [CommissionController::class, 'destroy'])
    ->name('admin.commissions.destroy');
Route::put('/mes-documents/{document}', [DocumentFournisseurController::class, 'update'])
    ->name('documents.update');

Route::delete('/mes-documents/{document}', [DocumentFournisseurController::class, 'destroy'])
    ->name('documents.destroy');
Route::get('/mes-commissions', [CommissionController::class, 'mesCommissions'])
    ->name('commissions.mes');
Route::resource('resultats-commissions', ResultatCommissionController::class);
Route::get(
    'resultats-commissions/{commission}/fournisseurs',
    [ResultatCommissionController::class, 'getFournisseurs']
)->name('resultats-commissions.fournisseurs');
});

Route::resource('appels_offres', AppelOffreController::class);

Route::resource('fournisseurs', FournisseurController::class);

Route::resource('invitations', InvitationController::class);

Route::get('/rapports', [RapportController::class, 'index'])
    ->name('admin.rapports.index');
Route::get('/admin/documents', [AdminDocumentController::class, 'index'])
    ->name('admin.documents.index');
Route::get('/dashboard', function () {

    $user = Auth::user();
    $appelsParMois = AppelOffre::selectRaw('MONTH(created_at) as mois, COUNT(*) as total')
    ->groupBy('mois')
    ->orderBy('mois')
    ->get();

$labels = [];
$totaux = [];

foreach ($appelsParMois as $item) {
    $labels[] = 'Mois '.$item->mois;
    $totaux[] = $item->total;
}

    $data = [

        'totalAppelsOffres' => AppelOffre::count(),

        'totalOffres' => Offre::count(),

        'totalFournisseurs' =>
            User::where('role', 'fournisseur')->count(),

        'totalInvitations' =>
            User::where('role', 'invite')->count(),

        'totalEnCours' =>
            AppelOffre::where('statut', 'En cours')->count(),

        'derniersAppels' =>
            AppelOffre::latest()->take(5)->get(),

        'statutsCounts' => [
            'Ouvert' =>
                AppelOffre::where('statut', 'Ouvert')->count(),

            'En cours' =>
                AppelOffre::where('statut', 'En cours')->count(),

            'Terminé' =>
                AppelOffre::where('statut', 'Terminé')->count(),
        ],
        'chartLabels' => $labels,
'chartData' => $totaux,
    ];

    if ($user->role === 'admin') {

    return view('admin.dashboard_admin', $data);

} elseif ($user->role === 'fournisseur') {

    return view('fournisseurs.dashboard_fournisseur', $data);

} elseif ($user->role === 'membre_commission') {

    return redirect()->route('commissions.mes');

} else {

    return view('dashboard_invite', $data);
}

})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';