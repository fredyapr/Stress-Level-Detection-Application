import 'package:dio/dio.dart';
import 'package:flutter/material.dart';
import 'package:project_reportnew/main.dart';
import 'package:project_reportnew/maps.dart';

class DetailKlinik extends StatefulWidget {
  @override
  _DetailKlinikState createState() => _DetailKlinikState();
}

class _DetailKlinikState extends State<DetailKlinik> {
  Future<List<Map<String, dynamic>>> _dataKlinik() async {
    Response response;
    Dio dio = new Dio();
    var url = "${MyHomePage.route}/api/klinik";
    response = await dio.post(url, data: {"status": 12});

    // Menampung data data klinik dari database
    List<Map<String, dynamic>> dataMap = [];
    for (var i = 0; i < response.data.length; i++) {
      var data = {
        "id": response.data[i]['id_klinik'],
        "nama": response.data[i]['nama_klinik'],
        "telp": response.data[i]['no_telp'],
        "alamat": response.data[i]['alamat_klinik'],
        "lat": response.data[i]['lat_klinik'],
        "long": response.data[i]['long_klinik'],
      };
      dataMap.add(data);
    }

    return dataMap;
  }
  // Untuk Popup detail
  void showSlideupView(BuildContext context, String nama, String telp,
      String alamat, String lat, String long) {
    double widthMax = MediaQuery.of(context).size.width;
    double x = double.parse(lat);
    double y = double.parse(long);
    showBottomSheet(
        context: context,
        builder: (context) {
          return new Container(
            height: 200,
            width: widthMax,
            color: Colors.blue,
            child: new GestureDetector(
              onTap: () => Navigator.pop(context),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: <Widget>[
                  Text(
                    nama,
                    style: TextStyle(
                        decoration: TextDecoration.underline,
                        fontWeight: FontWeight.bold,
                        fontSize: 30,
                        color: Colors.white),
                  ),
                  Text(
                    "Telepon: ${telp}",
                    style: TextStyle(
                        fontSize: 20,
                        color: Colors.white),
                  ),
                  Text(
                    "Alamat: ${alamat}",
                    style: TextStyle(
                        fontSize: 20,
                        color: Colors.white),
                  ),
                  RaisedButton(
                  color: Colors.white,
                  onPressed: () {
                    Navigator.push(
                      context,
                      MaterialPageRoute(builder: (context) => HomeScreen(x, y)),
                    );
                  },
                  child: Container(
                      width: 350,
                      child: Text(
                        "Lihat Peta",
                        textAlign: TextAlign.center,
                        style: TextStyle(color: Colors.blue, fontSize: 31),
                      )),
                  shape: RoundedRectangleBorder(
                      borderRadius: BorderRadius.circular(18.0),
                      side: BorderSide(color: Colors.white)),
                )
                ],
              ),
            ),
          );
        });
  }

  //Widget data, setelah get seluruh data dari database baru widget ini dirender
  Widget mapLocation(int id, String nama, String telp, String alamat,
      String lat, String long, BuildContext context) {
    return Card(
      child: ListTile(
        title: Container(child: Text(nama)),
        onTap: () {
          showSlideupView(context, nama, telp, alamat, lat, long);
        },
      ),
    );
  }

  //Ngeload data klinik
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text("Detail Klinik"),
      ),
      body: Container(
        child: FutureBuilder(
          future: _dataKlinik(),
          builder: (BuildContext context, AsyncSnapshot snapshot) {
            if (snapshot.connectionState != ConnectionState.done) {
              return Container(
                child: Center(
                  child: Text("Loading..."),
                ),
              );
            } else {
              if (snapshot.hasData) {
                return ListView.builder(
                  itemCount: snapshot.data.length,
                  itemBuilder: (BuildContext context, int index) {
                    return mapLocation(
                        snapshot.data[index]["id"],
                        snapshot.data[index]["nama"],
                        snapshot.data[index]["telp"],
                        snapshot.data[index]["alamat"],
                        snapshot.data[index]["lat"],
                        snapshot.data[index]["long"],
                        context);
                  },
                );
              } else {
                return Container(
                  child: Center(
                    child: Text("Data Kosong"),
                  ),
                );
              }
            }
          },
        ),
      ),
    );
  }
}
