<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<%@ page import="java.sql.*, db.DBConnection" %>
<%
    request.setCharacterEncoding("UTF-8");
    String cityId = request.getParameter("cityId");
    String name = request.getParameter("placeName");
    String type = request.getParameter("placeType");
    String desc = request.getParameter("description");

    try (Connection conn = DBConnection.getConnection()) {
        String sql = "INSERT INTO places (city_id, place_name, place_type, description) VALUES (?, ?, ?, ?)";
        PreparedStatement ps = conn.prepareStatement(sql);
        ps.setInt(1, Integer.parseInt(cityId));
        ps.setString(2, name);
        ps.setString(3, type);
        ps.setString(4, desc);
        ps.executeUpdate();
        
        // İşlem bitince şehre geri dön
        response.sendRedirect("city_detail.jsp?cityId=" + cityId);
    } catch (Exception e) {
        out.print("Veritabanı Hatası: " + e.getMessage());
    }
%>