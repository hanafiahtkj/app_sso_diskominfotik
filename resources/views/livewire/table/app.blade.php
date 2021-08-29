<div>
    <x-data-table :data="$data" :model="$app">
        <x-slot name="head">
            <tr>
                <th>
                    No
                </th>
                <th><a wire:click.prevent="sortBy('nama')" role="button" href="#">
                    Name
                    @include('components.sort-icon', ['field' => 'nama'])
                </a></th>
                <th><a wire:click.prevent="sortBy('keterangan')" role="button" href="#">
                    Keterangan
                    @include('components.sort-icon', ['field' => 'keterangan'])
                </a></th>
                <th><a wire:click.prevent="sortBy('created_at')" role="button" href="#">
                    Tanggal Dibuat
                    @include('components.sort-icon', ['field' => 'created_at'])
                </a></th>
                <th>Aksi</th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @php
                $perpage = $app->perPage();
                $currentPage = $app->currentPage();
                $start = $perpage * ($currentPage - 1);
            @endphp
            @foreach ($app as $ap)
                <tr x-data="window.__controller.dataTableController({{ $ap->id }})">
                    <td>{{ $loop->iteration + $start }}</td>
                    <td>{{ $ap->nama }}</td>
                    <td>{{ $ap->keterangan }}</td>
                    <td>{{ $ap->created_at->format('d M Y H:i') }}</td>
                    <td class="whitespace-no-wrap row-action--icon">
                        <a role="button" href="{{ route('app.edit', $ap->id) }}" class="mr-3"><i class="fa fa-16px fa-pen"></i></a>
                        <a role="button" x-on:click.prevent="deleteItem" href="#"><i class="fa fa-16px fa-trash text-red-500"></i></a>
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-data-table>
</div>
