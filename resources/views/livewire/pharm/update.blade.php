<form>
    <input type="hidden" name="id" wire:model="ids">
    <div class="row">
        <div class="form-group col-md-6">
            <label>Employee Name</label>
            <select class="form-select form-control" wire:model='employee' aria-label="Default select example">
                <option value="employee One">employee One</option>
                <option value="employee Two">employee Two</option>
                <option value="employee Three">employee Three</option>
            </select>
            @error('employee') <span class="text-danger">{{ $message }}</span>@enderror
        </div>

        <div class="form-group col-md-3">
            <label>Work Date From</label>
            <input class="form-control " type="date" wire:model='date_from'>
            @error('date_from') <span class="text-danger">{{ $message }}</span>@enderror
        </div>
        <div class="form-group col-md-3">
            <label>Work Date To</label>
            <input class="form-control " type="date" wire:model='date_to'>
            @error('date_to') <span class="text-danger">{{ $message }}</span>@enderror
        </div>
        @if ($date_to != null)
            <div class="form-group col-md-6">
                <label>Week Days</label>
                <select class="form-select form-control" wire:model='day' aria-label="Default select example">
                    <option value="saturday">Saturday</option>
                    <option value="sunday">Sunday</option>
                    <option value="monday">Monday</option>
                    <option value="tuesday">Tuesday</option>
                    <option value="wednesday">Wednesday</option>
                    <option value="thursday">Thursday</option>
                    <option value="friday">Friday</option>
                </select>
                @error('employee') <span class="text-danger">{{ $message }}</span>@enderror
            </div>
        @endif
    </div>
    @if ($day != null)
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Day</th>
                <th scope="col">Pharmacy</th>
                <th scope="col">Start Time</th>
                <th scope="col">End Time</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row">1</th>
                <td>
                    {{ $day }}
                </td>
                <td>
                    <div class="form-group">
                        <select class="form-select form-control" wire:model='pharmacy_name' aria-label="showField">
                            <option selected>Select Pharmacy</option>
                            <option value="Pharmacy One">Pharmacy One</option>
                            <option value="Pharmacy Two">Pharmacy Two</option>
                            <option value="Pharmacy Three">Pharmacy Three</option>
                        </select>
                        @error('pharmacy_name') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <input class="form-control" type="time" wire:model='start_time' id="example-date-input">
                        @error('start_time') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <input class="form-control" type="time" wire:model='end_time' id="example-date-input">
                        @error('end_time') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    @endif

    <button wire:click.prevent="update()" class="btn btn-primary btn-lg">Update</button>
    <hr>
</form>
