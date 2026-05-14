namespace HastaneRandevu.Models
{
    public class Prescription
    {
        public int ID { get; set; }
        public int AppointmentID { get; set; }
        public string MedicineList { get; set; }
        public string Instructions { get; set; }

        public Appointment Appointment { get; set; }
    }
}