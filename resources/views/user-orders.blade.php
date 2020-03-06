@extends('layouts.front')

@section('content')
<div class="row">
    <div class="col-12">
        <h2>Meus Pedidos </h2>
    </div>
    <div class="col-12">
    @forelse($userOrders as $key =>  $order)
        <div class="accordion" id="accordionExample">
            <div class="card">
                <div class="card-header" id="headingOne">
                    <h2 class="mb-0">
                         <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse{{$key}}" aria-expanded="true" aria-controls="collapseOne">
                            Pedido nº: {{$order->reference}}
                    </button>
                    </h2>
                </div>

                <div id="collapse{{$key}}" class="collapse @if($key == 0) show @endif" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body">
                    <h6>Pedido : {{auth()->user()->store->id}}</h6>
                        <ul>
                            @php $items = unserialize($order->items); @endphp
                            
                            @foreach($items as $item)
                                <li>
                                
                                {{$item['name']}} | R$ {{number_format($item['price'] * $item['amount'], 2, ',', '.')}}
                                <br>
                                Quantidade pedida: {{$item['amount']}}
                                </li>
                            @endforeach    
                        </ul>

                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-warning">Nenum Pedido</div> 
        @endforelse
        </div>

        
    </div>
    <div class="col-12">
            {{$userOrders->links()}}
        </div>
</div>
@endsection