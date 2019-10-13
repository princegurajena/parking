<form id="enquire-form" method="POST">
    @csrf
    <div class="card-body  border-bottom">
        <div class="d-flex align-items-center">
            <span class="mr-5 avatar avatar-{{ $location->occupied ? 'red' : ( $location->reserved ? 'orange' : 'green' ) }}">{{ $location->occupied ? 'O' : ( $location->reserved ? 'R' : 'A' ) }}</span>
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
        <div class="row">
            <div class="col-lg-12">
                <h6 class="text-muted">Booking</h6>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="vehicle" class="">Vehicle</label>
                    <select id="vehicle" type="text" class="form-control" name="vehicle" required>
                        <option value="">Choose Vehicle</option>
                        @foreach($cars as $car)
                            <option value="{{ $car->id }}">{{ $car->name }} - {{ $car->number }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="number" class="">Number of hours</label>
                    <input id="number" type="number" class="form-control" name="number" required>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="type" class="">Type</label>
                    <select id="type" type="text" class="form-control" name="type"  required>
                        <option value="">Choose</option>
                        <option value="park">Park Now</option>
                        <option value=reserve"">Reserve</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-12 text-center">
                <button type="submit" class="btn btn-primary px-4"><i class="fe fe-plus mr-2"></i>Book</button>
            </div>
        </div>
    </div>
</form>
