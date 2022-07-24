package Server;

import javax.xml.ws.Endpoint;
import Service.*;

public class Server{
	
	public static void main(String[] args)  {
		
		
		String url="http://localhost:8989/ActuService?wsdl";
		Endpoint.publish(url,new ActualiteService() );
		System.out.println(url);
		
	}

}
