<%@ Page Language="C#" %>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 <% 
     string sEndpoint = "https://secure.logmeinrescue.com/API/login.aspx";
     string sEmail = "some@email.com";
     string sPwd = "secretPassword";

     System.Net.HttpWebRequest oReq =
         (System.Net.HttpWebRequest)System.Net.WebRequest.Create(sEndpoint + "?email=" + sEmail + "&pwd=" + sPwd);
System.Net.HttpWebResponse oResp = (System.Net.HttpWebResponse)oReq.GetResponse();

string sResp = new System.IO.StreamReader(oResp.GetResponseStream()).ReadToEnd();
Response.Write(sResp);  //do something more elegant here

%>

<html xmlns="http://www.w3.org/1999/xhtml" >
<head id="Head1" runat="server">
    <title>Rescue API Login Test</title>
</head>
<body>

</body>
</html>