<?php

namespace App\Livewire;

use App\Models\CaseStudy;
use Livewire\Component;
use Livewire\WithPagination;

class PortfolioPage extends Component
{
    use WithPagination;

    public $search = '';
    public $industry = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'industry' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingIndustry()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = CaseStudy::where('is_published', true);

        if (!empty($this->search)) {
            $query->where('project_name', 'like', '%' . $this->search . '%')
                  ->orWhere('client_name', 'like', '%' . $this->search . '%');
        }

        if (!empty($this->industry)) {
            $query->where('industry', $this->industry);
        }

        $caseStudies = $query->latest()->paginate(12);
        
        // استخراج جميع المجالات المتاحة للفلترة
        $industries = CaseStudy::where('is_published', true)
                        ->whereNotNull('industry')
                        ->distinct()
                        ->pluck('industry');

        return view('livewire.portfolio-page', [
            'caseStudies' => $caseStudies,
            'industries' => $industries,
        ])->layout('layouts.public');
    }
}
