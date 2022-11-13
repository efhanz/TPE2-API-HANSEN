{include file="header.tpl"}

<div class="container">
  {if isset($smarty.session.user_ID)}

    <h4 class="mt-2">{$titulo1}</h4>


    <div class="dropdown dropend">
      <button class="btn btn-secondary btn-lg dropdown-toggle dropend
      {if !isset($smarty.session.user_ID)}disabled{/if}" type="button" data-bs-toggle="dropdown"
        aria-expanded="false">
        - ADD SELLER -
      </button>
      <div class="dropdown-menu dropdown-menu-dark dropend">
        <form class="row gx-3 gy-2 align-items-center container " action="createSeller" method="post">
          <div class="col-sm-3">
            <input type="text" name="seller" class="form-control" id="specificSizeInputName" placeholder="Seller"
              required>
          </div>
          <div class="col-sm-3">
            <input type="text" name="sales_area" class="form-control" id="specificSizeInputName" placeholder="Sales area"
              required>
          </div>
          <div class="col-sm-3">
            <input type="double" name="sales_commission" class="form-control" id="specificSizeInputName"
              placeholder="Commission percentage" required>
          </div>


          <div class="col-auto">
            <input type="submit" class="btn btn-dark" value="Load">
          </div>
        </form>

      </div>
    </div>
  {/if}


  <h1 class="my-4 d-flex justify-content-center">{$titulo2}</h1>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">Seller_ID</th>
        <th scope="col">Seller</th>
        <th scope="col">Sales_Area</th>
        <th scope="col">Sales_Commission</th>
        {if isset($smarty.session.user_ID)}
        <th scope="col">Delete</th>
        <th scope="col">Update</th>
      {/if}
      </tr>
    </thead>
    <tbody>
      {foreach from=$sellers item=$seller}
        <tr>
          <td><a href="sellerDetail/{$seller->Seller_ID}" class="btn btn-outline-success btn-sm">{$seller->Seller_ID} -
              Display</a></td>
          <td>{$seller->Seller}</td>
          <td>{$seller->Sales_Area}</td>
          <td>{$seller->Sales_Commission}</td>
          {if isset($smarty.session.user_ID)}
          <td><a href="deleteSeller/{$seller->Seller_ID}" class="btn btn-outline-danger btn-sm">Delete</a></td>
          <td><a href="sellerDetail/{$seller->Seller_ID}" class="btn btn-outline-success btn-sm">Display/Update</a></td>
          {/if}
        </tr>
      {/foreach}
    </tbody>
  </table>

  <div class="d-grid gap-2 d-md-flex justify-content-md-end">
    <button class="btn btn-outline-secondary"><a class="btn btn-secondary" href="showSeller">On the top</a></button>
    <button class="btn btn-outline-secondary"><a class="btn btn-secondary" href="home">Home</a></button>
  </div>
</div>

{include file="footer.tpl"}