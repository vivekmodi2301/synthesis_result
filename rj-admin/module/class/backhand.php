
<div class="form-group">
  <label class="col-lg-4 control-label">Received Amount (1<sup>st</sup> Installment)</label>
    <div class="col-lg-8">
    <input type="text" class="form-control" id="received_fee_1" name="received_fee_1" value="<?php
      if($total_fees) echo $total_fees[0]['fee_submit'];
    ?>" style="text-transform:capitalize;">
    </div>
</div>
<div class="form-group">
  <label class="col-lg-4 control-label">Received Amount (2<sup>nd</sup> Installment)</label>
    <div class="col-lg-8">
    <input type="text" class="form-control" id="received_fee_2" name="received_fee_2" value="<?php
      if($total_fees && isset($total_fees[1])) echo $total_fees[1]['fee_submit'];
    ?>" style="text-transform:capitalize;">
    </div>
</div>
