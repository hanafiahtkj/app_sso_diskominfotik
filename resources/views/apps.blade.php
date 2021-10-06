<x-guest-layout :kategori="$kategori"> 
    
    <livewire:apps /> 

    <x-slot name="style">
        <style>
            @media (max-width: 767px) { 
                .section > *:first-child {
                    margin-top: 70px!important;
                } 
            }
        </style>
    </x-slot>

</x-guest-layout>