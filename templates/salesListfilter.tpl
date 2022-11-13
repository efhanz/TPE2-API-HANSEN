{include file="header.tpl"}

<div class="container">

  <h2>{$titulo1}</h2>

  <h2 class="my-4 d-flex justify-content-center">{$titulo2}</h2>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">Transaction_ID</th>
        <th scope="col">Customer</th>
        <th scope="col">Invoice#</th>
        <th scope="col">Date</th>
        <th scope="col"> - Seller -</th>
        <th scope="col">Product</th>
        <th scope="col">Quantity</th>
        <th scope="col">Unit_Price</th>
        <th scope="col">Amount</th>
        {if isset($smarty.session.user_ID)}
        <th scope="col">Delete</th>
        <th scope="col">Update</th>
        {/if}
      </tr>
    </thead>
    <tbody>
      {foreach from=$sales item=$sale}
        <tr>
          <td><a href="saleDetail/{$sale->Transaction_ID}" class="btn btn-outline-success btn-sm">{$sale->Transaction_ID}
              - Display</a></td>
          <td>{$sale->Customer}</td>
          <td>{$sale->Invoice}</td>
          <td>{$sale->Date}</td>
          <td>{$sale->Seller} - {$sellers->Seller}</td>  
          <td>{$sale->Product}</td>
          <td>{$sale->Quantity}</td>
          <td>{$sale->Unit_Price}</td>
          <td>{$sale->Amount}</td>
          {if isset($smarty.session.user_ID)}
          <td><a href="deleteSale/{$sale->Transaction_ID}" class="btn btn-outline-danger btn-sm">Delete</a></td>
          <td><a href="saleDetail/{$sale->Transaction_ID}" class="btn btn-outline-success btn-sm">Display/Update</a></td>
        {/if}
        </tr>
      {/foreach}
    </tbody>
  </table>

  <div class="d-grid gap-2 d-md-flex justify-content-md-end">
    <button class="btn btn-outline-secondary"><a class="btn btn-secondary" href="showSales">back to top / return</a></button>
    <button class="btn btn-outline-secondary"><a class="btn btn-secondary" href="home">Home</a></button>
  </div>
</div>

{include file="footer.tpl"}   