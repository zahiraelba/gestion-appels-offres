<?php

namespace App\Http\Controllers;

use App\Models\AppelOffre;
use App\Models\Commission;
use Illuminate\Http\Request;
use App\Models\CommissionParticipant;
use Illuminate\Support\Facades\Auth;

class CommissionController extends Controller
{
    public function index()
    {
        $commissions = Commission::with('appelOffre')->get();

        return view('admin.commissions.index', compact('commissions'));
    }


    public function create(AppelOffre $appelOffre)
    {
        $membres = \App\Models\User::where('role', 'membre_commission')->get();
        return view('admin.commissions.create', compact('appelOffre','membres'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'appel_offre_id' => 'required|exists:appel_offres,id',
            'date_commission' => 'required|date',
            'heure' => 'required',
            'lieu' => 'required|string|max:255',
        ]);


        $commission = Commission::create([
            'appel_offre_id' => $request->appel_offre_id,
            'date_commission' => $request->date_commission,
            'heure' => $request->heure,
            'lieu' => $request->lieu,
            'statut' => 'Programmée',
        ]);


        // Ajouter les participants
        if ($request->has('participants')) {

            foreach ($request->participants as $participant) {

                if (
                    !empty($participant['prenom']) &&
                    !empty($participant['nom']) &&
                    !empty($participant['fonction']) &&
                    !empty($participant['matricule'])
                ) {

                    CommissionParticipant::create([
                        'commission_id' => $commission->id,
                        'user_id' =>$participant['user_id']??null,
                        'prenom' => $participant['prenom'],
                        'nom' => $participant['nom'],
                        'fonction' => $participant['fonction'],
                        'matricule' => $participant['matricule'],
                    ]);

                }
            }
        }


        return redirect()->route('dashboard')
            ->with('success', 'Commission créée avec succès.');
    }



    public function edit(Commission $commission)
    {
        $commission->load('participants');

        $appelOffre = $commission->appelOffre;

        return view('admin.commissions.edit', compact(
            'commission',
            'appelOffre'
        ));
    }



    public function update(Request $request, Commission $commission)
    {
        $request->validate([
            'appel_offre_id' => 'required|exists:appel_offres,id',
            'date_commission' => 'required|date',
            'heure' => 'required',
            'lieu' => 'required|string|max:255',
        ]);


        $commission->update([
            'appel_offre_id' => $request->appel_offre_id,
            'date_commission' => $request->date_commission,
            'heure' => $request->heure,
            'lieu' => $request->lieu,
        ]);



        // حذف المشاركين القدامى لتفادي التكرار
        $commission->participants()->delete();



        // إعادة حفظ المشاركين الحاليين
        if ($request->has('participants')) {

            foreach ($request->participants as $participant) {

                if (
                    !empty($participant['prenom']) &&
                    !empty($participant['nom']) &&
                    !empty($participant['fonction']) &&
                    !empty($participant['matricule'])
                ) {

                    CommissionParticipant::create([
                        'commission_id' => $commission->id,
                        'user_id' =>$participant['user_id']??null,
                        'prenom' => $participant['prenom'],
                        'nom' => $participant['nom'],
                        'fonction' => $participant['fonction'],
                        'matricule' => $participant['matricule'],
                    ]);

                }
            }
        }


        return redirect()->route('admin.commissions.index')
            ->with('success', 'Commission modifiée avec succès.');
    }



    public function destroy(Commission $commission)
    {
        $commission->participants()->delete();

        $commission->delete();

        return redirect()->route('admin.commissions.index')
            ->with('success', 'Commission supprimée avec succès.');
    }
    public function deleteParticipant(CommissionParticipant $participant)
{
    $participant->delete();

    return back()->with('success', 'Participant supprimé avec succès.');
}
public function mesCommissions()
{
    $commissions = Commission::whereHas('participants', function ($query) {
        $query->where('user_id', Auth::id());
    })
    ->with('appelOffre')
    ->get();

    return view('membre.commissions.dashboard_commission', compact('commissions'));
}
}