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
  <h1>WELCOME CUSTOMER {{auth()->guard('customer')->user()->name}}</h1><br>
  <a href="{{url('admin_logout')}}"> <button class="btn-sm btn-primary">Logout</button></a>
 
  <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
  Add Post
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Post</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="{{route('add_post')}}" method="POST" enctype="multipart/form-data">
      {{ csrf_field() }}
    <div class="form-group">
      <label for="email">Title</label>
      <input type="text" class="form-control" id="email" placeholder="Enter title" name="title">
    </div>
    <div class="form-group">
      <label for="description">Description</label>
   <textarea class="form-control" name="description">

   </textarea>
    </div>
    <p class="btn-sm btn-success addImage">Add new Image</p><br>
    <div class="form-group imageElement" >Upload Image
    <input type='file'name="extra[]" id="imgInp" data-id="1"/><br>
  <!-- <img id="blah" src="#" alt="your image"  height="200px" width="200px" /> -->
   

      </div>
      <div class="modal-footer">
        
        <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>
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
      <td>
        <img src="{{url('images/'.$e->image) }}"alt="Image" style="margin-top: 1.2rem;" height="100px" width="150px"><br></td>
    @endforeach
    </tr>
    @empty<tr>
        <td>No data</td>
</tr>
@endforelse
    
  </tbody>
</table>
<!-- REG -->
<script>
    imgInp.onchange = evt => {
        var attr=$(this).attr('data-id');
  const [file] = imgInp+attr.files
  if (file) {
    blah.src = URL.createObjectURL(file)
  }
}
var i=1;
$('.addImage').on('click',function(){
		//  alert("hi")
		  i++
          if(i<5){
			  	var imageElement = `
                  <input  type='file'name="extra[]" id="imgInp${i}" /><br>

			  	`;
                 // $(this).attr('data-id').val(i);
		  }
			  	$('.imageElement').append(imageElement);

		  		imgI++;
});

          </script>
</body>
</html>

