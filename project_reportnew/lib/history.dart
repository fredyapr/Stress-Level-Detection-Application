import 'package:dio/dio.dart';
import 'package:flutter/material.dart';
import 'package:project_reportnew/main.dart';
import 'package:shared_preferences/shared_preferences.dart';

class HistoryPage extends StatefulWidget {
  @override
  _HistoryPageState createState() => _HistoryPageState();
}

class _HistoryPageState extends State<HistoryPage> {
  Future<List<Map<String, dynamic>>> _dataKlinik() async {
    Response response;
    SharedPreferences pref = await SharedPreferences.getInstance();
    var idPen = pref.get("id_pengguna");
    Dio dio = new Dio();
    print("1");
    var url = "${MyHomePage.route}/api/history";
    response = await dio.post(url, data: {"status": 12, "id_pengguna": idPen});
    print(response.data['hasil'][0]['hasil']);

    List<Map<String, dynamic>> dataMap = [];
    for (var i = 0; i < response.data['hasil'].length; i++) {
      var data = {
        "id_hasil": response.data['hasil'][i]['id_hasil'].toString(),
        "id_pengguna": response.data['hasil'][i]['id_pengguna'].toString(),
        "hasil": response.data['hasil'][i]['hasil'].toString(),
        "create": response.data['hasil'][i]['created_at'].toString()
      };
      dataMap.add(data);
    }
    return dataMap;
  }

  void showSlideupView(BuildContext context, String id_hasil, String id_pengguna, String hasil) {
    double widthMax = MediaQuery.of(context).size.width;
    showBottomSheet(
        context: context,
        builder: (context) {
          return new Container(
            height: 100,
            width: widthMax,
            color: Colors.blue,
            child: new GestureDetector(
              onTap: () => Navigator.pop(context),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: <Widget>[
                  Text(
                    "Hasil: ",
                    style: TextStyle(
                        decoration: TextDecoration.underline,
                        fontWeight: FontWeight.bold,
                        fontSize: 30,
                        color: Colors.white),
                  ),
                  Text(
                    hasil,
                    style: TextStyle(
                        decoration: TextDecoration.underline,
                        fontWeight: FontWeight.bold,
                        fontSize: 30,
                        color: Colors.white),
                  ),
                ],
              ),
            ),
          );
        });
  }

  Widget mapLocation(String id_hasil, String id_pengguna, String hasil, String created,BuildContext context) {
    return Card(
      child: ListTile(
        title: Container(child: Text(created)),
        onTap: () {
          showSlideupView(context,id_hasil,id_pengguna,hasil);
        },
      ),
    );
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text("History Page"),
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
                        snapshot.data[index]["id_hasil"],
                        snapshot.data[index]["id_pengguna"],
                        snapshot.data[index]["hasil"],
                        snapshot.data[index]["create"],
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
