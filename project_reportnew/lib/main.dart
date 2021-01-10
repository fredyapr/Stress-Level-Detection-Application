import 'package:dio/dio.dart';
import 'package:flutter/material.dart';
import 'package:project_reportnew/Util/util.dart';
import 'package:project_reportnew/ready.dart';
import 'package:project_reportnew/register.dart';
import 'package:shared_preferences/shared_preferences.dart';
// import 'package:projectta/ready.dart';

void main() => runApp(MyApp());

class MyApp extends StatelessWidget {
  // This widget is the root of your application.
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'Flutter Demo',
      theme: ThemeData(
        primarySwatch: Colors.blue,
      ),
      // home: MyHomePage(title: 'Flutter Demo Home Page'),
      home: MyHomePage(),
    );
  }
}

class MyHomePage extends StatefulWidget {
  static var route = "http://192.168.43.150:8000";
  MyHomePage({Key key, this.title}) : super(key: key);

  final String title;

  @override
  _MyHomePageState createState() => _MyHomePageState();
}

class _MyHomePageState extends State<MyHomePage> {
  var _passwordController = TextEditingController();
  var _emailController = TextEditingController();

  bool valPassword = true;
  bool valEmail = true;
  
  //Login proses
  void loginProcess(BuildContext context) async {
    UtilAuth.loading(context);
    Response response;
    Dio dio = new Dio();
    var url = "${MyHomePage.route}/api/login";
    response = await dio.post(url, data: {
      "status": 12,
      "email_pengguna": _emailController.text,
      "password_pengguna": _passwordController.text
    });

    if (response.data['code'] == "0") {
      UtilAuth.failedPopupDialog(context, "Username / Password Salah");
    } else {
      SharedPreferences pref = await SharedPreferences.getInstance();
      pref.setInt("id_pengguna", response.data['id_pengguna']);
      Navigator.pushAndRemoveUntil(
        context,
        MaterialPageRoute(builder: (context) => Ready()),
        (Route<dynamic> route) => false,
      );
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Container(
          child: Text("Login Page"),
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
                "LOGIN",
                style: TextStyle(
                  fontWeight: FontWeight.bold,
                  fontSize: 28,
                ),
              ),
            ),
            SizedBox(
              height: 30,
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
                "Login",
                style: TextStyle(color: Colors.white, fontSize: 20),
              ),
              shape: RoundedRectangleBorder(
                  borderRadius: BorderRadius.circular(15.0),
                  side: BorderSide(color: Colors.blue)),
              onPressed: () {
                //validasi form input
                if (_emailController.text.isNotEmpty) {
                  setState(() {
                    valEmail = true;
                  });
                  if (_passwordController.text.isNotEmpty) {
                    setState(() {
                      valPassword = true;
                    });
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
              },
            ),
            RaisedButton(
                color: Colors.blue,
                child: Text(
                  "Register",
                  style: TextStyle(color: Colors.white, fontSize: 20),
                ),
                onPressed: () async {
                  SharedPreferences pref =
                      await SharedPreferences.getInstance();
                  pref.remove("id_pengguna");
                  Navigator.push(
                    context,
                    MaterialPageRoute(builder: (context) => RegisterPage()),
                  );
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
