<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>{{ isset($title)?$title:"Laravel" }}</title>
</head>

<body>
    <h1>{{ $details->details['title'] }}</h1>
    <p>{{ $details->details['body'] }}</p>

    <div class="col-md-12">
        <table class="table table-bordered text-center">
            
            <thead>
                <tr>
                    <!-- <th>Product</th> -->
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                </tr>
                @if($details->details['orderDetail'])
                    @foreach($details->details['orderDetail']->products as $rows)
                        <tr>
                            <!-- <td><img src="" width="145px" height="98px" style="object-fit: cover;" alt=""></td> -->
                            <td style="vertical-align: middle;">{{ $rows['productInfo']->name }}</td>
                            <td style="vertical-align: middle;">{{ number_format($rows['productInfo']->price) }}</td>
                            <td style="vertical-align: middle;">
                                <div class="number-input md-number-input">

                                    <input class="quantity w-25 text-center" name="quantity" value="{{ $rows['quantity'] }}" type="number" disabled>

                                </div>
                            </td>

                        </tr>
                    @endforeach
                @endif
            </thead>
            
        </table>
    </div>



    <p>Thank you !</p>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>