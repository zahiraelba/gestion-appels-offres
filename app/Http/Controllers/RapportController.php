<?php

namespace App\Http\Controllers;

use App\Models\AppelOffre;
use App\Models\Fournisseur;
use App\Models\Offre;
use App\Models\Invitation;

class RapportController extends Controller
{
    public function index()
    {
        $totalAppels = AppelOffre::count();
        $totalFournisseurs = Fournisseur::count();
        $totalInvitations= Invitation::count();
        $totalOffres = Offre::count();
        
        $ouverts = AppelOffre::where('statut', 'Ouvert')->count();
        $encours = AppelOffre::where('statut', 'En cours')->count();
        $termines = AppelOffre::where('statut', 'Terminé')->count();

        $derniers = AppelOffre::latest()->take(5)->get();

        return view('admin.rapports.index', compact(
            'totalAppels',
            'totalFournisseurs',
            'totalInvitations',
            'totalOffres',
            'ouverts',
            'encours',
            'termines',
            'derniers'
        ));
    }
   public function exportExcel()
{
    $appels = AppelOffre::all();

    $filename = "rapport_appels_offres.xls";

    $headers = [
        "Content-Type" => "application/vnd.ms-excel",
        "Content-Disposition" => "attachment; filename=$filename",
    ];

    $html = '
    <html>
    <head>
    <meta charset="UTF-8">
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th {
            background: #334155;
            color: white;
            padding: 10px;
        }
        td {
            padding: 8px;
            border: 1px solid #ddd;
        }
    </style>
    </head>
    <body>

    <h2>Rapport des Appels d\'Offres</h2>

    <table>
        <tr>
            <th>Référence</th>
            <th>Titre</th>
            <th>Budget</th>
            <th>Statut</th>
            <th>Date limite</th>
        </tr>';

    foreach ($appels as $appel) {

        $html .= '
        <tr>
            <td>'.$appel->reference.'</td>
            <td>'.$appel->titre.'</td>
            <td>'.$appel->budget_estime.' DH</td>
            <td>'.$appel->statut.'</td>
            <td>'.$appel->date_limite.'</td>
        </tr>';

    }

    $html .= '
    </table>

    </body>
    </html>';

    return response($html, 200, $headers);
}
}
