<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Faq;
use App\Models\CustomFieldValue;
use App\Models\CustomFieldGroup;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class CreateFaqs extends Component
{
    public $action;
    public $button;

    public $faq;
    public $faqId;

    protected function getRules()
    {
        $rules = [];

        return array_merge([
            'faq.question'   => 'required|min:3',
            'faq.answer'     => 'required',
            'faq.sort_order' => 'required'
        ], $rules);
    }

    public function createFaq ()
    {
        $this->resetErrorBag();
        $this->validate();

        Faq::create($this->faq);

        $this->emit('saved');
        $this->reset('faq');
    }

    public function updateFaq ()
    {
        $this->resetErrorBag();
        $this->validate();

        Faq::query()
            ->where('id', $this->faqId)
            ->update($this->faq);

        $this->emit('saved');
    }

    public function mount ()
    {
        if (!$this->faq && $this->faqId) {
            $this->faq = Faq::find($this->faqId)->toArray();
        }
    
        $this->button = create_button($this->action, "Faqs");
    }

    public function render()
    {
        // dd($this->faq);
        return view('livewire.create-faq');
    }
}
