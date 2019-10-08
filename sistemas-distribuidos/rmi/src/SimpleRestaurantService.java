import java.rmi.RemoteException;
import java.rmi.server.UnicastRemoteObject;
import java.util.ArrayList;

public class SimpleRestaurantService extends UnicastRemoteObject implements RestaurantService
{

    private static String nameService = "RestaurantService";
    private static String host = "localhost";
    private static Integer port = 1099;

    protected SimpleRestaurantService() throws RemoteException
    {
        super();
    }

    @Override
    public ArrayList<Item> getMenu() throws RemoteException {
        ArrayList<Item> items = new ArrayList<Item>();
        items.add(new Item("Item 1", 10.00));
        items.add(new Item("Item 2", 8.50));
        items.add(new Item("Item 3", 5.00));
        items.add(new Item("Item 4", 4.5));

        Item.resetGenerateId();

        return items;
    }

    public static String getUri()
    {
        String uri = String.format("rmi://%s:%d/%s", host, port, nameService);

        return uri;
    }
}
