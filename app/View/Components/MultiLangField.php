<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class MultiLangField extends Component
{
    public function __construct(
        public string $type,
        public string $name,
        public string $label,
        public Collection $languages,
        public ?array $values = [],
    ) {}

    public function render(): View
    {
        return view('components.multi-lang-field');
    }
}
