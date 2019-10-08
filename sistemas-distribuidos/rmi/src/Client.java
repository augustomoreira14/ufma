import java.rmi.Naming;

public class Client
{
    public static void main(String[] args)
    {
        try{
            RestaurantService restaurantService = (RestaurantService) Naming.lookup(SimpleRestaurantService.getUri());

            System.out.println("#Cardápio:");
            for (Item i: restaurantService.getMenu()) {
                System.out.println(String.format("%d: %s - %.2f",
                        i.getId(),
                        i.getName(),
                        i.getPrice()
                ));
            }

        }catch (Exception e){
            e.printStackTrace();
        }
    }
}
