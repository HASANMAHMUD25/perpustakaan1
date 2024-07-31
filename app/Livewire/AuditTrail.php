<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Audit;

class AuditTrail extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $auditIdToShow = null;

    protected $queryString = ['search'];

    protected $listeners = ['showAuditModal'];

    public function showAuditDetails($auditId)
    {
        $this->auditIdToShow = $auditId;
        $this->dispatch('showAuditModal');
    }

    public function closeModal()
    {
        $this->auditIdToShow = null;
        $this->dispatch('closeAuditModal');
    }

    public function searchBuku()
    {
        $this->resetPage();
    }
    

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $audits = Audit::search($this->search)
            ->orderBy('id') // Urutkan berdasarkan ID secara ascending (terkecil ke terbesar)
            ->paginate(10);
            if ($this->search && $audits->isEmpty()) {
                session()->flash('gagal', 'Data tidak ditemukan.');
            }

        return view('livewire.audit-trail', [
            'audits' => $audits
        ]);
    }
}
