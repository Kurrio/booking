<!DOCTYPE html>
<html>
<head>
  <title></title>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="{{ asset('css/main.css') }}" rel="stylesheet">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>
@role((['Administrator','SuperBruker','Bruker']))
	{{ csrf_field() }}
	<div class="container-fluid">
		<div class="row">
			@include ('layouts.sidebar')
			<div class="col-sm-10">
			<!-- Setter inn en "bar" øverst dersom nytt rom ble opprettet -->
			    @if(session()->has('success'))
				<div class="alert alert-success">
					{{ session('success') }}
				</div>
			    @endif
				<div class="page-header room_header_div">
					<div class="container-fluid">
						<div class="col-sm-10">
							<h1> {{ $room->name }} <small> {{ $room->capacity }} plasser</small></h1>
						</div>
						<div class="col-sm-1">
						<a href="/bookingV" class="btn btn-default btn-lg room_button"
						data-toggle="tooltip" data-placement="bottom" title="Gå tilbake til booking">
							<span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
						</a>
						</div>
						@role(('Administrator'))
						<div class="col-sm-1">
							<a href="/rooms/edit_room/{{$room->id}}" class="btn btn-default btn-lg room_button"
							data-toggle="tooltip" data-placement="bottom" title="Instillinger">
								<span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
							</a>
						</div>
						@endrole
					</div>
				</div>
			  <!-- your page content -->
				<div class="container-fluid col-sm-6">
					<div class="row">
						<img src="{{ asset('images/meeting-room-g1.jpg')}}" height="50%" width="100%"/>
					</div>
					<div class="row">
						<div class="well well-sm">
							<br/>
							<p><b>Rom til:</b><span> {{ $room->capacity }} personer</span></p>
							<p><b>Utstyr:</b><span> {{ $room->equipment }} </span></p>
							<p><b>Etasje:</b><span> {{ $room->floor }} </span></p>
						</div>
					</div>
				</div>
					<br/>
				<div class="container-fluid col-sm-1"></div>
				<div class="row room_lister">
				  <div class="book_a_room col-sm-5">
					<table class="roomTableRoomShow">
						<?php $range=range(strtotime("08:00"),strtotime("22:00"),30*60) ?>
					  @foreach($range as $time)
					    <tr class="roomTrRoomShow">
					      <th class="roomTdRoomShow" id="firstTd">
					        <?php $date = date("H:i",$time); 
					        echo $date;?>
					      </th>
					      <td class="roomTdRoomShow tdspacing" data-format="HH:mm" role="button"> 
					      </td>
					    </tr>
					    @endforeach
					    <!--
						<tr class="roomTrRoomShow">
							<th class="roomTdRoomShow" id="firstTd">
								08:00
							</th>
							<td class="roomTd tdspacing">
								
							</td>
						</tr>
					<tr class="roomTr">
							<th class="roomTd">
								08:30
							</th>
							<td class="roomTd tdspacing">
								
							</td>
						</tr>
						<tr class="roomTr">
							<th class="roomTd">
								09:00
							</th>
							<td class="roomTd tdspacing">

							</td>
						</tr>
					<tr class="roomTr">
					  <th class="roomTd">
						09:30
					  </th>
					  <td class="roomTd tdspacing">
						
					  </td>
					</tr>
					<tr class="roomTr">
					  <th class="roomTd">
						10:00
					  </th>
					  <td class="roomTd tdspacing">
						
					  </td>
					</tr>
					<tr class="roomTr">
					  <th class="roomTd">
						10:30
					  </th>
					  <td class="roomTd tdspacing">
						
					  </td>
					</tr>
					<tr class="roomTr">
					  <th class="roomTd">
						11:00
					  </th>
					  <td class="roomTd tdspacing">

					  </td>
					</tr>
					<tr class="roomTr">
					  <th class="roomTd">
						11:30
					  </th>
					  <td class="roomTd tdspacing">
						
					  </td>
					</tr>

					<tr class="roomTr">
					  <th class="roomTd">
						12:00
					  </th>
					  <td class="roomTd tdspacing">
						
					  </td>
					</tr>

					<tr class="roomTr">
					  <th class="roomTd">
						12:30
					  </th>
					  <td class="roomTd tdspacing">
						
					  </td>
					</tr>

					<tr class="roomTr">
					  <th class="roomTd">
						13:00
					  </th>
					  <td class="roomTd tdspacing">
						
					  </td>
					</tr>

					<tr class="roomTr">
					  <th class="roomTd">
						13:30
					  </th>
					  <td class="roomTd tdspacing">
						
					  </td>
					</tr>

					<tr class="roomTr">
					  <th class="roomTd">
						14:00
					  </th>
					  <td class="roomTd tdspacing">
						
					  </td>
					</tr>

					<tr class="roomTr">
					  <th class="roomTd">
						14:30
					  </th>
					  <td class="roomTd tdspacing">
						
					  </td>
					</tr>

					<tr class="roomTr">
					  <th class="roomTd">
						15:00
					  </th>
					  <td class="roomTd tdspacing">
						
					  </td>
					</tr>

					<tr class="roomTr">
					  <th class="roomTd">
						15:30
					  </th>
					  <td class="roomTd tdspacing">
						
					  </td>
					</tr>

					<tr class="roomTr">
					  <th class="roomTd">
						16:00
					  </th>
					  <td class="roomTd tdspacing">
						
					  </td>
					</tr>

					<tr class="roomTr">
					  <th class="roomTd">
						16:30
					  </th>
					  <td class="roomTd tdspacing">
						
					  </td>
					</tr>
					-->
					</table>
					</div>
				</div>
			</div>
		</div>
	</div>
@endrole
</body>
</html>