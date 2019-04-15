    
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="mb-0">
                	<i class="fa fa-exclamation-circle text-danger"></i> Danger!
                </h4>
            </div>
            <div class="modal-body">
                <p>You just pressed on the delete button.</p>
                <p>This is very dangerous!</p>
                <br>
                <p>When pressing on the delete button product <b>{{$product->product_name}}</b> will be deleted permanently!</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                {!! Form::open(['action' => ['ProductsController@destroy', $product->product_id], 'methode' => 'POST']) !!}
					{{Form::hidden('_method', 'DELETE')}}
					{{Form::submit('Delete', ['class' => 'btn btn-outline-danger btn-ok'])}}
				{!! Form::close() !!}
            </div>
        </div>
    </div>
</div>