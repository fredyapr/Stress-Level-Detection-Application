import 'package:flutter/material.dart';
import 'package:google_maps_flutter/google_maps_flutter.dart';

class HomeScreen extends StatefulWidget {
  double lat;
  double long;
  HomeScreen(this.lat, this.long);
  @override
  _HomeScreenState createState() => _HomeScreenState();
}

class _HomeScreenState extends State<HomeScreen> {
  static double x;
  static double y;
  final Set<Marker> _markers = {};
  LatLng _currentPosition;

  @override
  void initState() {
   
    setState(() {
      x = widget.lat;
      y = widget.long;
    });
     print(x);
     print(y);
     _currentPosition = LatLng(x, y);
    _markers.add(
      Marker(
        markerId: MarkerId("$x, $y"),
        position: _currentPosition,
        icon: BitmapDescriptor.defaultMarker,
      ),
    );

    
    super.initState();
  }



  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Detail maps klinik'),
      ),
      body: GoogleMap(
        mapType: MapType.normal,
        initialCameraPosition: CameraPosition(
          target: _currentPosition,
          zoom: 14.0,
        ),
        markers: _markers,
      ),
    );
  }
}