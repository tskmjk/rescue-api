<%@ Page Language="C#" %>
<%@ Import Namespace="System.Net" %>
<%@ Import Namespace="System.IO" %>
<%@ Import Namespace="System" %>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 <% 
     string sEndpoint = "https://secure.logmeinrescue.com/API/";  //add actionName.aspx? for each action called
     string sEmail = "some@email.com";
     string sPwd = "secretPassword";

     //set up the request
     HttpWebRequest oReq = (HttpWebRequest)System.Net.WebRequest.Create(sEndpoint + "login.aspx" + "?email=" + sEmail + "&pwd=" + sPwd);
    
     //create a cookie container to store the cookies for this session 
     oReq.CookieContainer = new CookieContainer();
     
     
     //get the response
     HttpWebResponse oResp = (HttpWebResponse)oReq.GetResponse();

string sResp = new StreamReader(oResp.GetResponseStream()).ReadToEnd();
Response.Write("Login result: " + sResp + "<br />");  //do something more elegant here

/*
//debug cookies
foreach (Cookie cook in oResp.Cookies)
{
Response.Write("Cookie:" + "<br />");
Response.Write("Name: " + cook.Name + " " + "Value: " + cook.Value + "<br />");
Response.Write("Domain: " + cook.Domain + "<br />");
Response.Write("Path: " + cook.Path + "<br />");
Response.Write("Port: " + cook.Port + "<br />");
Response.Write("Secure: " + cook.Secure + "<br />");

Response.Write("When issued: " + cook.TimeStamp + "<br />");
Response.Write("Expires: " + cook.Expires + " " + "Expired? " + cook.Expired + "<br />");
Response.Write("Don't save: " + cook.Discard + "<br />");
Response.Write("Comment: " + cook.Comment + "<br />");
Response.Write("Uri for comments: " + cook.CommentUri + "<br />");
Response.Write("Version: RFC " + cook.Version + "<br />");
    
// Show the string representation of the cookie.
Response.Write("String: " + cook.ToString());
}*/
     
//add cookies to cookie container
CookieContainer sessioncookie = oReq.CookieContainer;

//get the ReportDate info
string sBDate = "01/01/2007";
string sEDate = "12/31/2007";
HttpWebRequest oReqReportDate = (HttpWebRequest)System.Net.WebRequest.Create(sEndpoint + "setReportDate.aspx?bdate=" + sBDate + "&edate=" + sEDate);
oReqReportDate.CookieContainer = sessioncookie;

HttpWebResponse oRespReportDate = (HttpWebResponse)oReqReportDate.GetResponse();
string sRespReportDate = new StreamReader(oRespReportDate.GetResponseStream()).ReadToEnd();
Response.Write("setReportDate result: " + sRespReportDate + "<br />");  //do something more elegant here


%>

<html xmlns="http://www.w3.org/1999/xhtml" >
<head id="Head1" runat="server">
    <title>Rescue API setReportDate Test</title>
</head>
<body>

</body>
</html>