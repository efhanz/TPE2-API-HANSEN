{include file="header.tpl"}

<div class="container">

  <h2 class="my-4 d-flex justify-content-center">{$titulo}</h2>


  <div class="container">
    <ul class="list-group">
      <li class="list-group-item">Seller_ID: {$seller->Seller_ID}</li>
      <li class="list-group-item">Seller's Name: {$seller->Seller}</li>
      <li class="list-group-item">Sales'Area: {$seller->Sales_Area}</li>
      <li class="list-group-item">Sales'Commission: {$seller->Sales_Commission}</li>

    </ul>
  </div>

</div>

<div class="container">
  {if isset($smarty.session.user_ID)}
  <div class="container text-center btn-group">
    <button class="btn btn-secondary btn-lg dropdown-toggle" type="button" data-bs-toggle="dropdown"
      data-bs-display="static" aria-expanded="false">
      - UPDATE THE SELLER (please, check it before confirm) -
    </button>
    <div class="dropdown-menu dropdown-menu-dark dropdown dropdown-menu-end dropdown-menu-lg-start">
      <form class="row gx-3 gy-2 align-items-center container dropdown-menu-end "
        action="updateSeller/{$seller->Seller_ID}" method="post">


        <div class="col-sm-3">
          <label>Seller</label><input type="text" name="seller" value="{$seller->Seller}" class="form-control"
            id="specificSizeInputName" placeholder="" required>
        </div>

        <div class="col-sm-3">
          <label>Sales_Area</label><input type="text" name="sales_area" value="{$seller->Sales_Area}"
            class="form-control" id="specificSizeInputName" placeholder="" required>
        </div>

        <div class="col-sm-3">
          <label>Sales_Commission</label><input type="double" name="sales_commission"
            value="{$seller->Sales_Commission}" class="form-control" id="specificSizeInputName" placeholder="" required>
        </div>

        <div class="col-auto">
          <input type="submit" class="btn btn-dark" value="Send">
        </div>

      </form>

    </div>
  </div>
  {/if}

</div class="container">

<div class="d-grid gap-2 d-md-flex justify-content-md-end">
  <button class="btn btn-outline-secondary"><a class="btn btn-secondary" href="showSeller">Return</a></button>
  <button class="btn btn-outline-secondary"><a class="btn btn-secondary" href="home">Home</a></button>
</div>




{include file="footer.tpl"}