<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<%@ page import="java.sql.*, db.DBConnection" %>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Şehir Rehberi</title>
    <link rel="stylesheet" href="style.css"> </head>
<body>
    <div class="container">
        <h1>🌍 Şehir Rehberi ve Gezi Rotaları</h1>
        <p>Keşfetmek istediğin şehri seç ve maceraya başla!</p>
        
        <%
            try (Connection conn = DBConnection.getConnection()) {
                Statement stmt = conn.createStatement();
                ResultSet rs = stmt.executeQuery("SELECT * FROM cities ORDER BY city_name");
                
                while(rs.next()) {
        %>
                    <div class="card">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <div>
                                <h2><%= rs.getString("city_name") %></h2>
                                <p>📍 Bölge: <%= rs.getString("region") %> | 👥 Nüfus: <%= rs.getInt("population") %></p>
                            </div>
                            <a href="city_detail.jsp?cityId=<%= rs.getInt("id") %>" class="btn">Detayları Gör</a>
                        </div>
                    </div>
        <%
                }
            } catch (Exception e) {
                out.println("<div class='card' style='color:red;'>Hata: " + e.getMessage() + "</div>");
            }
        %>
    </div>
</body>
</html>