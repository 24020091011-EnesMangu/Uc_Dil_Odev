package db;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;

public class DBConnection {
    public static Connection getConnection() throws ClassNotFoundException, SQLException {
        // PostgreSQL sürücüsünü yükle
        Class.forName("org.postgresql.Driver");
        
        // Bağlantı bilgilerini buraya yazıyoruz
        String url = "jdbc:postgresql://localhost:5432/sehir_rehberi"; // Veritabanı adın
        String user = "postgres"; // PostgreSQL kullanıcı adın (genelde postgres)
        String password = "enes"; // Kurulumda koyduğun şifre
        
        return DriverManager.getConnection(url, user, password);
    }
}