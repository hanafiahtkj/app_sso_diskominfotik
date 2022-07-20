<x-guest-layout>

    <div class="overflow-hidden sm:rounded-lg">
        <div class="p-6 sm:px-10 text-center">

            <div class="mt-0 text-2xl">
                <b>FAQ</b>
            </div>
        
            <div class="mt-0 text-2xl">
			    Halo, ada yang bisa kami bantu?
            </div>

            <div class="mt-6 text-gray-500 text-left">
                
                <div id="accordion">
                    @foreach ($faqs as $item)
                
                    <div class="card mb-3">
                      <div class="card-header" id="heading{{ $loop->index }}">
                        <h5 class="mb-0">
                          <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse{{ $loop->index }}" aria-expanded="false" aria-controls="collapse{{ $loop->index }}">
                            #{{ $loop->iteration }} {{ $item->question }}
                          </button>
                        </h5>
                      </div>
                      <div id="collapse{{ $loop->index }}" class="collapse" aria-labelledby="heading{{ $loop->index }}" data-parent="#accordion">
                        <div class="card-body">
                          {!! $item->answer !!}
                        </div>
                      </div>
                    </div>

                    @endforeach
                </div>

            </div>
        </div>
    </div>
    
</x-guest-layout>