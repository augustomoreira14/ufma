import java.io.Serializable;

public class Item implements Serializable
{
    private Integer id;
    private String name;
    private Double price;
    private static Integer nextId = 1;

    public Item(String name, Double price)
    {
        this.name = name;
        this.price = price;
        this.id = getNextId();
    }

    protected static Integer getNextId()
    {
        Integer nextIdCurrent = nextId;
        nextId += 1;

        return nextIdCurrent;
    }

    public Integer getId() {
        return id;
    }

    public String getName() {
        return name;
    }

    public Double getPrice() {
        return price;
    }

    public static void resetGenerateId()
    {
        nextId = 1;
    }
}
