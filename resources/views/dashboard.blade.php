<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h1>ADMIN DASHBOARD</h1>
 <a href="{{url('admin_logout')}}"> <button class="btn-sm btn-primary">Logout</button></a>
</div>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Customer name</th>
      <th scope="col">Email/Phone</th>
      <th scope="col">Post title</th>
      <th scope="col">description</th>
      <th scope="col">Image</th>
    </tr>
  </thead>
  <tbody>
    @forelse($customer as $c)
    <tr>
      <th scope="row">{{ $customer->firstItem() + $loop->index }}</th>
      <td>{{$c->name}}</td>
      <td>{{$c->email}}<br>{{$c->phone}}</td>
      <td>{{$c->title}}</td>
      <td>{{$c->description}}</td>
      @foreach($extra->where('post_id',$c->post_id)->values() as $e)
      <td><img src="{{url('images/'.$e->image) }}"alt="Image" style="margin-top: 1.2rem;" height="200px" width="250px"></td>
    @endforeach
    </tr>
    @empty<tr>
        <td>No data</td>
</tr>
@endforelse
    
  </tbody>
</table>
<!-- REG -->


</body>
</html>