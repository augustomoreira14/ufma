import java.rmi.Naming;
import java.rmi.Remote;
import java.rmi.registry.LocateRegistry;

public class Server
{
    public Server()
    {
        try{
            LocateRegistry.createRegistry(1099);
            RestaurantService restaurantService = (RestaurantService) new SimpleRestaurantService();

            Naming.rebind(SimpleRestaurantService.getUri(), (Remote) restaurantService);

        }catch (Exception e){
            e.printStackTrace();
        }
    }

    public static void main(String[] args)
    {
        new Server();
    }
}
