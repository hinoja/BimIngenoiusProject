<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Plan;
use App\Models\News;
use App\Models\Quote;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $year = $request->input('year', now()->year);
        $years = range(now()->year - 5, now()->year);

        // Statistiques globales
        $stats = [
            'totalProjects' => Project::count(),
            'totalUsers' => User::count(),
            'totalCategories' => Category::count(),
            'totalPlans' => Plan::count(),
            'totalNews' => News::count(),
            'totalQuotes' => Quote::count(),
            'totalMessages' => Contact::count(), // Removed because Message model does not exist
        ];

        // Projets par mois (pour le graphique)
        $projectsPerMonth = Project::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->toArray();

        // Répartition par catégorie
        $projectsByCategory = Category::withCount(['projects' => function ($q) use ($year) {
            $q->whereYear('created_at', $year);
        }])->get();

        // Répartition par statut
        $projectsByStatus = Project::select('status', DB::raw('COUNT(*) as count'))
            ->whereYear('created_at', $year)
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        // Top 10 des pays avec le plus de projets
        $projectsByCountry = Project::select('country', DB::raw('COUNT(*) as count'))
            ->whereNotNull('country')
            ->whereYear('created_at', $year)
            ->groupBy('country')
            ->orderByDesc('count')
            ->limit(10)
            ->pluck('count', 'country')
            ->toArray();

        // Répartition des projets par taille
        $projectsBySize = Project::select('size', DB::raw('COUNT(*) as count'))
            ->whereYear('created_at', $year)
            ->groupBy('size')
            ->pluck('count', 'size')
            ->toArray();

        // Évolution mensuelle des contacts et devis
        $contactsPerMonth = Contact::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->pluck('count', 'month')
            ->toArray();

        $quotesPerMonth = Quote::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->pluck('count', 'month')
            ->toArray();

        // Taux de conversion
        $totalContacts = $stats['totalMessages'];
        $totalQuotes = $stats['totalQuotes'];
        $stats['conversionRate'] = $totalContacts > 0 ? round(($totalQuotes / $totalContacts) * 100, 2) : 0;

        // Préparation des données pour Chart.js
        $chartData = [
            'projectsPerMonth' => [
                'labels' => collect(range(1, 12))->map(fn($m) => \Carbon\Carbon::create()->month($m)->format('M'))->toArray(),
                'data' => array_replace(array_fill(1, 12, 0), $projectsPerMonth),
            ],
            'projectsByCategory' => [
                'labels' => $projectsByCategory->pluck('name')->toArray(),
                'data' => $projectsByCategory->pluck('projects_count')->toArray(),
            ],
            'projectsByStatus' => [
                'labels' => array_keys($projectsByStatus),
                'data' => array_values($projectsByStatus),
            ],
            'projectsByCountry' => [
                'labels' => array_keys($projectsByCountry),
                'data' => array_values($projectsByCountry),
            ],
            'projectsBySize' => [
                'labels' => array_keys($projectsBySize),
                'data' => array_values($projectsBySize),
            ],
            'requestsPerMonth' => [
                'labels' => collect(range(1, 12))->map(fn($m) => \Carbon\Carbon::create()->month($m)->format('M'))->toArray(),
                'contacts' => array_replace(array_fill(1, 12, 0), $contactsPerMonth),
                'quotes' => array_replace(array_fill(1, 12, 0), $quotesPerMonth),
            ],
        ];

        return view('admin.dashboard', compact('year', 'years', 'stats', 'chartData'));
    }
}
