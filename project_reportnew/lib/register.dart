import 'package:dio/dio.dart';
import 'package:flutter/material.dart';
import 'package:project_reportnew/Util/util.dart';
import 'package:project_reportnew/main.dart';

class RegisterPage extends StatefulWidget {
  @override
  _RegisterPageState createState() => _RegisterPageState();
}

class _RegisterPageState extends State<RegisterPage> {
  var _passwordController = TextEditingController();
  var _emailController = TextEditingController();
  var _namaController = TextEditingController();

  bool valPassword = true;
  bool valEmail = true;
  bool valNama = true;

  void loginProcess(BuildContext context) async {
    // UtilAuth.loading(context);
    Response response;
    Dio dio = new Dio();
    var url = "${MyHomePage.route}/api/register";
    response = await dio.post(url, data: {
      "status": 12,
      "nama_pengguna": _namaController.text,
      "email_pengguna": _emailController.text,
      "password_pengguna": _passwordController.text
    });

    if (response.data['code'] == "0") {
      UtilAuth.failedPopupDialog(context, "Email Telah Ada");
    } else {
      Navigator.pushAndRemoveUntil(
        context,
        MaterialPageRoute(builder: (context) => MyHomePage()),
        (Route<dynamic> route) => false,
      );
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Container(
          child: Text("Register Page"),
        ),
      ),
      body: Container(
        child: ListView(
          children: <Widget>[
            SizedBox(
              height: 10,
            ),
            Center(
              child: Text(
                "REGISTER",
                style: TextStyle(
                  fontWeight: FontWeight.bold,
                  fontSize: 28,
                ),
              ),
            ),
            SizedBox(
              height: 30,
            ),
            Text(
              "Nama:",
              style: TextStyle(fontSize: 25),
            ),
            TextField(
              decoration: InputDecoration(
                  hintText: "Masukan Nama Lengkap",
                  errorText: valNama ? null : "Input Nama!"),
              controller: _namaController,
            ),
            SizedBox(
              height: 10,
            ),
            Text(
              "Email:",
              style: TextStyle(fontSize: 25),
            ),
            TextField(
              keyboardType: TextInputType.emailAddress,
              decoration: InputDecoration(
                  hintText: "Masukan Email Lengkap",
                  errorText: valEmail ? null : "Input Email!"),
              controller: _emailController,
            ),
            SizedBox(
              height: 10,
            ),
            Text(
              "Password:",
              style: TextStyle(fontSize: 25),
            ),
            TextField(
              obscureText: true,
              decoration: InputDecoration(
                  hintText: "Masukan Password Lengkap",
                  errorText: valPassword ? null : "Input Password!"),
              controller: _passwordController,
            ),
            SizedBox(
              height: 20,
            ),
            RaisedButton(
                color: Colors.blue,
                child: Text(
                  "Daftar",
                  style: TextStyle(color: Colors.white, fontSize: 20),
                ),
                onPressed: () {
                  if (_namaController.text.isNotEmpty) {
                    setState(() {
                      valNama = true;
                    });

                    if (_emailController.text.isNotEmpty) {
                      setState(() {
                        valEmail = true;
                      });
                      if (_passwordController.text.isNotEmpty) {
                        setState(() {
                          valPassword = true;
                        });
                        print(_namaController.text);
                        print(_emailController.text);
                        print(_passwordController.text);
                        loginProcess(context);
                      } else {
                        setState(() {
                          valPassword = false;
                        });
                      }
                    } else {
                      setState(() {
                        valEmail = false;
                      });
                    }
                  } else {
                    setState(() {
                      valNama = false;
                    });
                  }
                },
                shape: RoundedRectangleBorder(
                    borderRadius: BorderRadius.circular(15.0),
                    side: BorderSide(color: Colors.blue))),
          ],
        ),
      ),
    );
  }
}
