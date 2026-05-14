namespace HastaneRandevu.Models
{
    public class Doctor
    {
        public int ID { get; set; }
        public int ClinicID { get; set; }
        public string FullName { get; set; }
        public string Title { get; set; }

        public Clinic Clinic { get; set; } // Hangi kliniğe bağlı
        public ICollection<Appointment> Appointments { get; set; }
    }
}