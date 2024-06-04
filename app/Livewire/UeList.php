<?php

namespace App\Livewire;

use App\Models\Specialty;
use App\Models\TeachingUnit;
use Livewire\Component;

use function PHPUnit\Framework\isEmpty;

class UeList extends Component
{
    public $title;
    public Specialty $specialty;
    public $semesters = [];

    public $teachingUnitsSelectedId;
    public $teachingUnitsSelected = [];
    public $teachingUnits;

    public function mount($specialtyId, $semester)
    {
        $this->specialty = Specialty::findOrFail($specialtyId);
        $this->semesters[] = $semester;
        $this->title = 'Ue list';
        $this->teachingUnitsSelectedId = [];
    }

    public function addTeachingUnit($id)
    {
        if (in_array($id, $this->teachingUnitsSelectedId)) {
            $key = array_search($id, $this->teachingUnitsSelectedId);
            unset($this->teachingUnitsSelectedId[$key]);
        } else {
            $this->teachingUnitsSelectedId[] = $id;
        }
        $this->teachingUnitsSelected = TeachingUnit::findMany($this->teachingUnitsSelectedId);
    }

    public function addSemester($semester){
        if (in_array($semester, $this->semesters)) {
            $key = array_search($semester, $this->semesters);
            unset($this->semesters[$key]);
        } else {
            $this->semesters[] = $semester;
        }
        $this->getData();
    }

    private function getData()
    {
        $this->teachingUnits = $this->specialty->teachingUnits()->whereIn('semester', $this->semesters)->orderBy('semester')->get();
    }

    public function render()
    {
        $this->getData();
        return view('livewire.ue-list');
    }
}
