<!DOCTYPE html>
<html>
<head>
    <title>Product Catalogue</title>
    <style>
        @page {
            margin: 20px;
            @top-center {
                content: element(page-header);
            }
        }

        .page-header {
            height: 150px;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        .background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        .background img {
            width: 100%;
            max-width: 100%;
            object-fit: contain;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .container {
            width: 100%;
        }
        .row {
            clear: both;
            page-break-inside: avoid;
            margin-bottom: 20px;
        }
        .product {
            float: left;
            width: 13%;
            margin: 1%;
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
            box-sizing: border-box;
        }
        .product img {
            width: 100%;
            background: #f0f0f0;
            margin-bottom: 8px;
        }
        .product-name {
            font-weight: bold;
            margin: 8px 0;
            font-size: 12px;
        }
        .product-price {
            color: #666;
            font-size: 11px;
        }
        .row:after {
            content: "";
            display: table;
            clear: both;
        }
    </style>
</head>
<body>
<div class="background">
    <img src="{{ $backgroundUrl }}" alt="Background">
</div>

<div class="container">
    @foreach($products->chunk(6) as $chunk)
        {{--        Header--}}
        @if ($loop->first || $loop->iteration % 5 == 1)
            <div class="row">
                <div class="page-header" style="text-align: center;" id="page-header">
{{--                    <h1>Product Catalogue</h1>--}}
{{--                    <p>Products #{{ request('from') }} to #{{ request('to') }}</p>--}}
                </div>
            </div>
        @endif
        {{--    items product--}}
        <div class="row">
            @foreach($chunk as $product)
                <div class="product">
                    <img
                        width="800px"
                        height="120px"
                        src="{{ $product->image ? url($product->image) : 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAMAAAADACAYAAABS3GwHAAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAALEwAACxMBAJqcGAAAABl0RVh0U29mdHdhcmUAd3d3Lmlua3NjYXBlLm9yZ5vuPBoAAANQSURBVHic7dShDQMxAARB+2WULiUr6NIlS5cu3RGSBc4zE7DaU7R6zvkA1H6vvgDwTQJAlAAQJQBECQBRAkCUABAlAEQJAFECQJQAECUARAkAUQJAlAAQJQBECQBRAkCUABAlAEQJAFECQJQAECUARAkAUQJAlAAQJQBECQBRAkCUABAlAEQJAFECQJQAECUARAkAUQJAlAAQJQBECQBRAkCUABAlAEQJAFECQJQAECUARAkAUQJAlAAQJQBECQBRAkCUABAlAEQJAFECQJQAECUARAkAUQJAlAAQJQBECQBRAkCUABAlAEQJAFECQJQAECUARAkAUQJAlAAQJQBECQBRAkCUABAlAEQJAFECQJQAECUARAkAUQJAlAAQJQBECQBRAkCUABAlAEQJAFECQJQAECUARAkAUQJAlAAQJQBECQBRAkCUABAlAEQJAFECQJQAECUARD3nnKuvAPwLTwBRAkCUABAlAEQJAFECQJQAECUARL0oEghwFO9gngAAAABJRU5ErkJggg==' }}"
                        alt="Product Image">
                    <div class="product-name">{{ $product->name }}</div>
                    <div class="product-price">{{$product->price}}</div></div>
            @endforeach
        </div>
    @endforeach
</div>
</body>
</html>
