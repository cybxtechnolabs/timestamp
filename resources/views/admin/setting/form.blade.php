<form action="{{ route('setting.update') }}" method="post">
{{ csrf_field() }}
<div class="form-group">
      <label for="formGroupExampleInput">Multiple Record Time</label>
      <input type="text" class="form-control"  id="multiple_record_time"  name="multiple_record_time" placeholder="Example input">
    </div>

    <fieldset class="form-group">
      <div class="row">
        <legend class="col-form-label col-sm-2 pt-0">Skip Mask</legend>
        <div class="col-sm-10">
          <div class="form-check">
            <input class="form-check-input" type="radio" name="skip_mask" id="skip_mask1" value="option1" checked>
            <label class="form-check-label" for="gridRadios1">
              On
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="skip_mask" id="skip_mask2" value="option2">
            <label class="form-check-label" for="gridRadios2">
              Off
            </label>
          </div>
        </div>
      </div>
    </fieldset>

    <div class="form-group">
      <label for="formGroupExampleInput">Max Temperature</label>
      <input type="text" class="form-control" id="threshold_temperature"  name="threshold_temperature" placeholder="Example input">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
  </form>