import 'package:dio/dio.dart';
import 'package:flutter/material.dart';
import 'package:project_reportnew/Util/util.dart';
import 'package:project_reportnew/ready.dart';
import 'package:project_reportnew/solusi.dart';

import 'main.dart';

class ResultPage extends StatefulWidget {
  String hasilText;
  ResultPage(this.hasilText);
  @override
  _ResultPageState createState() => _ResultPageState();
}

class _ResultPageState extends State<ResultPage> {
  // @override
  // void initState() {
  //   if (widget.hasilText == "Stres Berat") {

  //   }
  //   super.initState();
  // }

  void callSolusi() async {
    // UtilAuth.loading(context);
    Response response;
    Dio dio = new Dio();
    var url = "${MyHomePage.route}/api/solusi";
    response = await dio.post(url, data: {"status": 12});
    List<Map<String, dynamic>> solusiList = [];

    for (var i = 0; i < response.data.length; i++) {
      var sol = {
        "solusi": response.data[i]['solusi'],
        "ket": response.data[i]['keterangan'],
      };
      solusiList.add(sol);
    }

    Navigator.push(context,
        MaterialPageRoute(builder: (context) => SolusiPage(solusiList)));
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text("Result"),
      ),
      body: Container(
          child: Center(
        child: ListView(
          children: <Widget>[
            Column(
              crossAxisAlignment: CrossAxisAlignment.center,
              children: <Widget>[
                SizedBox(
                  height: 20,
                ),
                Text(
                  "SELESAI",
                  style: TextStyle(
                    fontSize: 40,
                    fontWeight: FontWeight.bold,
                  ),
                ),
                Text(
                  "KATERANGAN: ",
                  style: TextStyle(
                    fontSize: 40,
                  ),
                ),
                Text(
                  '${widget.hasilText}',
                  style: TextStyle(
                    fontSize: 45,
                  ),
                ),
                SizedBox(
                  height: 80,
                ),
                Text(
                  "Check Solusi ",
                  style: TextStyle(
                    fontSize: 30,
                  ),
                ),
                SizedBox(
                  height: 10,
                ),
                Row(
                  mainAxisAlignment: MainAxisAlignment.center,
                  children: <Widget>[
                    Container(
                      width: 150,
                      height: 170,
                      child: RaisedButton(
                        color: Colors.blue,
                        onPressed: () {
                          callSolusi();
                        },
                        child: Container(
                            child: Column(
                          children: <Widget>[
                            SizedBox(
                              height: 30,
                            ),
                            Icon(
                              Icons.lightbulb_outline,
                              color: Colors.white,
                              size: 100,
                            ),
                            Text(
                              "Solusi",
                              textAlign: TextAlign.center,
                              style:
                                  TextStyle(color: Colors.white, fontSize: 25),
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
                      width: 150,
                      height: 170,
                      child: RaisedButton(
                        color: Colors.blue,
                        onPressed: () {
                          Navigator.pushAndRemoveUntil(
                            context,
                            MaterialPageRoute(builder: (context) => Ready()),
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
                              Icons.home,
                              color: Colors.white,
                              size: 100,
                            ),
                            Text(
                              "Halaman Utama",
                              textAlign: TextAlign.center,
                              style:
                                  TextStyle(color: Colors.white, fontSize: 19),
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
            )
          ],
        ),
      )),
    );
  }
}
