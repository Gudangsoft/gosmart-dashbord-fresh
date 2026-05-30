<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
    <div class="container pt-3">
        <p style="text-align:center;">
            <img src="{{asset('img/logo.png')}}" style="text-align:center;width:180px;height:50px;">
        </p>
        <div class="card text-center mt-4">
            <div class="card-body">
              {{-- <h5 class="card-title">{{ strtoupper($data_class->name) }}</h5> --}}
              <p class="card-text">Lanjutkan pembayaran dan nikmati kelas premium di g-academy.</p>
              <a href="#" id="pay-button" class="btn btn-primary">Bayar Sekarang</a>
              {{-- <a href="/learning/dashboard/{{ auth()->user()->id }}" class="btn btn-dark">Dashboard</a> --}}
            </div>
            <div class="card-body" id="result-json">
            </div>
        </div>
    </div>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
    <script type="text/javascript">
      document.getElementById('pay-button').onclick = function(){
        snap.pay('{{ $snapToken }}', {
          onSuccess: function(result){
            /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
          },
          // Optional
          onPending: function(result){
            /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
          },
          // Optional
          onError: function(result){
            /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
          }
        });
      };
    </script>
</body>
</html>
{{-- <html>
  <body>
    <button id="pay-button">Pay!</button>
    <pre><div id="result-json">JSON result will appear here after payment:<br></div></pre>

<!-- TODO: Remove ".sandbox" from script src URL for production environment. Also input your client key in "data-client-key" -->

  </body>
</html> --}}
