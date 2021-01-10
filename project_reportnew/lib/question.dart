import 'package:dio/dio.dart';
import 'package:flutter/material.dart';
import 'package:group_radio_button/group_radio_button.dart';
import 'package:project_reportnew/Util/util.dart';
import 'package:project_reportnew/main.dart';
import 'package:project_reportnew/result.dart';
import 'package:shared_preferences/shared_preferences.dart';

class Question extends StatefulWidget {
  List<String> pertanyaans;

  Question(this.pertanyaans);

  @override
  _QuestionState createState() => _QuestionState();
}

class _QuestionState extends State<Question> {
  void simpanData(BuildContext context) async {
    SharedPreferences pref = await SharedPreferences.getInstance();
    var id = pref.get("id_pengguna");
    UtilAuth.loading(context);
    // API
    Response response;
    Dio dio = new Dio();
    var url = "${MyHomePage.route}/api/hasil";
    response = await dio
        .post(url, data: {"status": 12, "total": total, "id_pengguna": id});
    var dt = response.data['data'];

    if (dt == "Stres Berat") {
      UtilAuth.pemberitahuanPop(
          context,
          "Anda memiliki tingkatan stres berat, Harap baca solusi yang disediakan. Lakukan tes kembali setelah 3 Hari.",
          ResultPage(dt));
    } else {
      Navigator.pushAndRemoveUntil(
        context,
        MaterialPageRoute(builder: (context) => ResultPage(dt)),
        (Route<dynamic> route) => false,
      );
    }
  }

  Widget popsUp(BuildContext context){
    print("Hello");
return UtilAuth.failedPopupDialog(context, "Tidak Dapat Keluar!");
  }

  Future<bool> _onBackPressed() {
  return showDialog(
    context: context,
    builder: (context) => new AlertDialog(
      title: new Text('Peringatan!'),
      content: new Text('Harap Selesaikan Test Anda Terlebih Dahulu!'),
      actions: <Widget>[
        new GestureDetector(
          onTap: () => Navigator.of(context).pop(false),
          child: Text("OK"),
        ),
      ],
    ),
  ) ??
      false;
}

  int indexes = 0;
  String _singleValue = "Text alignment right";
  String _verticalGroupValue = "";
  int total = 0;

  bool validasi = true;

  List<String> _status = [
    "Tidak Pernah",
    "Hampir Tidak Pernah",
    "Kadang-Kadang",
    "Sering",
    "Sangat Sering"
  ];
  @override
  Widget build(BuildContext context) {
    int lengths = widget.pertanyaans.length;
    return Scaffold(
        appBar: AppBar(
          title: Text("Question Page"),
        ),
        body: WillPopScope(
          onWillPop: () {
            Future.value(false);
            return _onBackPressed();
            
          },
          child: Container(
            child: ListView(
              children: <Widget>[
                Center(child: Text("Question Page")),
                SizedBox(
                  height: 20,
                ),
                Text(
                  "Pertanyaan:",
                  style: TextStyle(fontSize: 20),
                ),
                Text(
                  widget.pertanyaans[indexes],
                  style: TextStyle(fontSize: 25),
                ),
                SizedBox(
                  height: 20,
                ),
                validasi == false
                    ? Center(
                        child: Text(
                          "PILIH JAWABAN TELEBIH DAHULU",
                          style: TextStyle(
                              fontSize: 20,
                              color: Colors.red,
                              fontWeight: FontWeight.bold),
                        ),
                      )
                    : Container(),
                RadioGroup<String>.builder(
                  groupValue: _verticalGroupValue,
                  onChanged: (value) => setState(() {
                    if (indexes == 3 ||
                        indexes == 4 ||
                        indexes == 6 ||
                        indexes == 7) {
                      if (value == "Tidak Pernah") {
                        _verticalGroupValue = value;
                        total += 4;
                      } else if (value == "Hampir Tidak Pernah") {
                        _verticalGroupValue = value;
                        total += 3;
                      } else if (value == "Kadang-Kadang") {
                        _verticalGroupValue = value;
                        total += 2;
                      } else if (value == "Sering") {
                        _verticalGroupValue = value;
                        total += 1;
                      } else if (value == "Sangat Sering") {
                        _verticalGroupValue = value;
                        total += 0;
                      }
                    } else {
                      if (value == "Tidak Pernah") {
                        _verticalGroupValue = value;
                        total += 0;
                      } else if (value == "Hampir Tidak Pernah") {
                        _verticalGroupValue = value;
                        total += 1;
                      } else if (value == "Kadang-Kadang") {
                        _verticalGroupValue = value;
                        total += 2;
                      } else if (value == "Sering") {
                        _verticalGroupValue = value;
                        total += 3;
                      } else if (value == "Sangat Sering") {
                        _verticalGroupValue = value;
                        total += 4;
                      }
                    }
                  }),
                  items: _status,
                  itemBuilder: (item) => RadioButtonBuilder(
                    item,
                  ),
                ),
                RaisedButton(
                    color: Colors.blue,
                    child: Text(
                      "Next",
                      style: TextStyle(color: Colors.white),
                    ),
                    onPressed: () {
                      print(_verticalGroupValue);

                      if (_verticalGroupValue != "") {
                        setState(() {
                          if (indexes + 1 < lengths) {
                            indexes = indexes + 1;
                            validasi = true;
                          } else {
                            // Print total nilai
                            UtilAuth.loading(context);
                            simpanData(context);
                            //

                          }
                          _verticalGroupValue = "";
                        });
                      } else {
                        setState(() {
                          validasi = false;
                        });
                      }
                    })
              ],
            ),
          ),
        ));
  }
}
