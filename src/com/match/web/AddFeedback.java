package com.match.web; 
import com.match.model.Match;

import javax.servlet.*;
import javax.servlet.http.*;
import javax.servlet.jsp.*;
import javax.servlet.jsp.tagext.SimpleTagSupport;
import java.io.*;
import org.apache.logging.log4j.LogManager;
import org.apache.logging.log4j.Logger;

public class AddFeedback extends HttpServlet {
  private static final Logger logger = LogManager.getLogger("match");
  public void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException, NumberFormatException {
    
    //Gets the string data of all of the fields in the form to register

    //TODO: Make sure you get your field here that you create as well
    String sid = request.getParameter("id");
    String sid2 = request.getParameter("id2");
    boolean rating = request.getParameter("rate").equals("1");
    //get your parameter from the request here 
	try {
		int id = Integer.parseInt(sid);
		int id2 = Integer.parseInt(sid2);
	} catch (Exception e) {
		response.sendRedirect("invalidinput");
	}
    //check to see if the values entered are valid input, if not, redirects the response to the invalid input page
    if (!Match.isMatch(sid, sid2)) {
      response.sendRedirect("invalidinput");
    } else {
        //Here we make the call to the method in Person that connects to the database and inserts the person with the given values
        //Your addPerson method should accept one more argument at the end which contains the field you created

        Match.feedback(sid2, rating);
        //Sends the response to the add page so that another person can be added. ID is passed as a parameter to display the id 
        //for the new user to refer to get and view matches
        response.sendRedirect("feedback?id=" + sid);
    }
    
    
  }
}