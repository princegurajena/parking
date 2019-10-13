<form id="confirm-form" action="/parking/{{ $request->id }}/accept" method="POST">
    @csrf
    <div class="card-body  border-bottom">
        <div class="d-flex align-items-center">
            <span class="mr-5 avatar avatar-{{ $location->occupied ? 'red' : ( $location->reserved ? 'orange' : 'green' ) }}"></span>
            <div class="row flex-grow-1">
                <div class="col-6">
                    <div>
                        <div><span>Name : </span> {{ $location->name }} </div>
                        <div><span>Road : </span> {{ $location->road }}</div>
                        <div><span>City : </span> {{ $location->city }}</div>
                    </div>
                </div>
                <div class="col-6">
                    <div>
                        <div><span>Rate : </span> $ {{ $location->rate }} per hour </div>
                        <div><span>Activity : </span> {{ $location->updated_at->diffForHumans() }} </div>
                        <div><span>Status : </span> {{ $location->occupied ? 'occupied' :  ( $location->reserved  ? 'reserved' : 'available') }}</div>
                    </div>
                </div>
            </div>
        </div>
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
    <div class="card-body {{ $location->occupier || $location->reserver ? 'd-none' : '' }}">
        <div class="d-flex align-items-center">
            <span class="mr-5 avatar avatar-{{ $location->occupied ? 'red' : ( $location->reserved ? 'orange' : 'green' ) }}"></span>
            <div class="row flex-grow-1">
                <div class="col-6">
                    <div>
                        <div><span>Name: </span> {{ $request->vehicle->name }} </div>
                        <div><span>Number : </span> {{ $request->vehicle->number }}</div>
                    </div>
                </div>
                <div class="col-6">
                    <div>
                        <div><span>Name : </span> {{ $request->user->name }} </div>
                        <div><span>Email : </span> {{ $request->user->email }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body text-center {{ $location->occupier || $location->reserver ? 'd-none' : '' }}">
        <button type="submit" class="btn btn-primary px-5"><i class="fe fe-check-circle mr-2"></i>Accept</button>
    </div>
</form>
