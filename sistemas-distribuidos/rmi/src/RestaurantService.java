import java.rmi.Remote;
import java.rmi.RemoteException;
import java.util.ArrayList;

public interface RestaurantService extends Remote
{
    public ArrayList<Item> getMenu() throws RemoteException;
}
