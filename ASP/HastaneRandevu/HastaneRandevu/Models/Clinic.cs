using System.Numerics;

namespace HastaneRandevu.Models
{
    public class Clinic
    {
        public int ID { get; set; }
        public string Name { get; set; }
        public int Floor { get; set; }
        public string Specialty { get; set; }

        // Bir kliniğin birden fazla doktoru olabilir (İlişki)
        public ICollection<Doctor> Doctors { get; set; }
    }
}