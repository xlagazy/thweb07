<div class="modal fade" id="modalsumstock" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Summary Stock</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">

            <table class="table table-sm">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Material Name</th>
                        <th scope="col">Stock</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($stockmaterial as $stockmaterials)
                        <tr>
                            <td scope="col">#</td>
                            <td scope="col">{{$stockmaterials->material_name}}</td>
                            <td scope="col">{{$stockmaterials->sumstockqty}}</td>
                        </tr>
                    @endforeach
                </tbody>
                </table>
                
            </div>
        </div>
    </div>
</div>