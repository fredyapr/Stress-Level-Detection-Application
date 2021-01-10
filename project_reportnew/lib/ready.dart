import 'package:dio/dio.dart';
import 'package:flutter/material.dart';
import 'package:project_reportnew/Util/util.dart';
import 'package:project_reportnew/detailklinik.dart';
import 'package:project_reportnew/history.dart';
import 'package:project_reportnew/main.dart';
import 'package:project_reportnew/question.dart';

class Ready extends StatefulWidget {
  @override
  _ReadyState createState() => _ReadyState();
}

class _ReadyState extends State<Ready> {
  void dataPertanyaan() async {
    UtilAuth.loading(context);
    Response response;
    Dio dio = new Dio();
    var url = "${MyHomePage.route}/api/kuesioner";
    response = await dio.post(url, data: {"status": 12});

    List<String> pertanyaan = [];
    for (var i = 0; i < response.data.length; i++) {
      pertanyaan.add(response.data[i]['nama_kuesioner']);
    }
    Navigator.pushAndRemoveUntil(
      context,
      MaterialPageRoute(builder: (context) => Question(pertanyaan)),
      (Route<dynamic> route) => false,
    );
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text("Halaman Utama"),
      ),
      body: Container(
        child: Column(
          children: <Widget>[
            Center(
                child: Text(
              "Aplikasi Stress Detector",
              style: TextStyle(fontWeight: FontWeight.bold, fontSize: 30),
            )),
            SizedBox(
              height: 50,
            ),
            Row(
              mainAxisAlignment: MainAxisAlignment.center,
              children: <Widget>[
                Container(
                  width: 170,
                  height: 200,
                  child: RaisedButton(
                    color: Colors.blue,
                    onPressed: () {
                      dataPertanyaan();
                    },
                    child: Container(
                        child: Column(
                      children: <Widget>[
                        SizedBox(
                          height: 30,
                        ),
                        Icon(
                          Icons.mode_edit,
                          color: Colors.white,
                          size: 100,
                        ),
                        Text(
                          "Mulai Test",
                          textAlign: TextAlign.center,
                          style: TextStyle(color: Colors.white, fontSize: 25),
                        ),
                      ],
                    )),
                    shape: RoundedRectangleBorder(
                        borderRadius: BorderRadius.circular(12.0),
                        side: BorderSide(color: Colors.blue)),
                  ),
                ),
                SizedBox(
                  width: 30,
                ),
                Container(
                  width: 170,
                  height: 200,
                  child: RaisedButton(
                    color: Colors.blue,
                    onPressed: () {
                      Navigator.push(
                        context,
                        MaterialPageRoute(builder: (context) => DetailKlinik()),
                      );
                    },
                    child: Container(
                        child: Column(
                      children: <Widget>[
                        SizedBox(
                          height: 30,
                        ),
                        Icon(
                          Icons.local_hospital,
                          color: Colors.white,
                          size: 100,
                        ),
                        Text(
                          "Klinik",
                          textAlign: TextAlign.center,
                          style: TextStyle(color: Colors.white, fontSize: 25),
                        ),
                      ],
                    )),
                    shape: RoundedRectangleBorder(
                        borderRadius: BorderRadius.circular(12.0),
                        side: BorderSide(color: Colors.blue)),
                  ),
                ),
              ],
            ),
            SizedBox(
              height: 30,
            ),
            Row(
              mainAxisAlignment: MainAxisAlignment.center,
              children: <Widget>[
                Container(
                  width: 170,
                  height: 200,
                  child: RaisedButton(
                    color: Colors.blue,
                    onPressed: () {
                      Navigator.push(
                        context,
                        MaterialPageRoute(builder: (context) => HistoryPage()),
                      );
                    },
                    child: Container(
                        child: Column(
                      children: <Widget>[
                        SizedBox(
                          height: 30,
                        ),
                        Icon(
                          Icons.history,
                          color: Colors.white,
                          size: 100,
                        ),
                        Text(
                          "History",
                          textAlign: TextAlign.center,
                          style: TextStyle(color: Colors.white, fontSize: 25),
                        ),
                      ],
                    )),
                    shape: RoundedRectangleBorder(
                        borderRadius: BorderRadius.circular(12.0),
                        side: BorderSide(color: Colors.blue)),
                  ),
                ),
                SizedBox(
                  width: 30,
                ),
                Container(
                  width: 170,
                  height: 200,
                  child: RaisedButton(
                    color: Colors.blue,
                    onPressed: () {
                      Navigator.pushAndRemoveUntil(
                        context,
                        MaterialPageRoute(builder: (context) => MyHomePage()),
                        (Route<dynamic> route) => false,
                      );
                    },
                    child: Container(
                        child: Column(
                      children: <Widget>[
                        SizedBox(
                          height: 30,
                        ),
                        Icon(
                          Icons.exit_to_app,
                          color: Colors.white,
                          size: 100,
                        ),
                        Text(
                          "Logout",
                          textAlign: TextAlign.center,
                          style: TextStyle(color: Colors.white, fontSize: 25),
                        ),
                      ],
                    )),
                    shape: RoundedRectangleBorder(
                        borderRadius: BorderRadius.circular(12.0),
                        side: BorderSide(color: Colors.blue)),
                  ),
                ),
              ],
            ),
          ],
        ),
      ),
    );
  }
}
