<div>
    <div class="alert alert-success card-alert text-center">
        You will be redirected to and external site to complete payment
    </div>
    <div class="card-body border-top-0 {{ $location->occupier || $location->reserver ? 'd-none' : '' }}">
        <div class="d-flex align-items-center">
            <span class="mr-5 avatar avatar-{{ $location->occupied ? 'red' : ( $location->reserved ? 'orange' : 'green' ) }}"></span>
            <div class="row flex-grow-1">
                <div class="col-6">
                    <div>
                        <div><span>Number : </span> {{ $request->number }} </div>
                        <div><span>Amount : </span> {{ $request->amount }} </div>
                        <div><span>Status : </span> {{ $request->status }} </div>
                    </div>
                </div>
                <div class="col-6">
                    <div>
                        <div><span>Start : </span> {{ $request->created_at }} </div>
                        <div><span>End : </span> {{ $request->end }}</div>
                        <div><span>Activity : </span> {{ $request->updated_at->diffForHumans() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body text-center {{ $location->occupier || $location->reserver ? 'd-none' : '' }}">
        <a href="{{ $link }}" class="btn btn-primary px-5"><i class="fe fe-check-circle mr-2"></i>Proceed to pay</a>
    </div>
</div>
