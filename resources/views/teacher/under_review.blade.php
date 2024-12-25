<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>NIC | Teacher's Joining Request is Under Review</title>

    <style>
      /* Custom styles to center the card vertically and horizontally */
      .full-height {
        height: 100vh;
      }
      .centered-card {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 100%;
        max-width: 600px; /* Limit card width */
      }
    </style>
  </head>
  <body>

    <!-- Container for the centered card -->
    <div class="container full-height">
      <div class="row justify-content-center align-items-center full-height">
        <div class="col-md-6 centered-card">
          <!-- Card Start -->
          <div class="card shadow">
            <div class="card-header text-center">
              <h5 class="card-title">Teacher Joining Request</h5>
            </div>
            <div class="card-body text-center">
              <!-- Warning Image -->
              <div class="row justify-content-center mb-3">
                <img src="{{ asset('assets/icons/triangle-warning.png') }}" style="width: 128px;" alt="Warning Icon" />
              </div>

              <!-- Hourglass Icon -->
              <i class="bi bi-hourglass-split" style="font-size: 3rem; color: orange;"></i>
              <h4 class="mt-3">Your Request is Under Review</h4>
              <p>The teacher's joining request is currently being reviewed. Please wait for the response.</p>
            </div>
          </div>
          <!-- Card End -->
        </div>
      </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  </body>
</html>
