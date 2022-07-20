<div>
    <x-data-table :data="$data" :model="$faqs">
        <x-slot name="head">
            <tr>
                <th><a wire:click.prevent="sortBy('question')" role="button" href="#">
                    Pertanyaan
                    @include('components.sort-icon', ['field' => 'question'])
                </a></th>
                <th><a wire:click.prevent="sortBy('sort_order')" role="button" href="#">
                    Urut
                    @include('components.sort-icon', ['field' => 'sort_order'])
                </a></th>
                <th>Aksi</th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @php
                $perpage = $faqs->perPage();
                $currentPage = $faqs->currentPage();
                $start = $perpage * ($currentPage - 1);
            @endphp
            @foreach ($faqs as $faq)
                <tr x-data="window.__controller.dataTableController({{ $faq->id }})">
                    <td>{{ $faq->question }}</td>
                    <td>{{ $faq->sort_order }}</td>
                    <td class="whitespace-no-wrap row-action--icon">
                        <a role="button" href="{{ route('faqs.edit', $faq->id) }}" class="mr-3"><i class="fa fa-16px fa-pen"></i></a>
                        <a role="button" x-on:click.prevent="deleteItem" href="#"><i class="fa fa-16px fa-trash text-red-500"></i></a>
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-data-table>
</div>
