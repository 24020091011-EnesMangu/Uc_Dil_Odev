using Microsoft.EntityFrameworkCore;
using Microsoft.AspNetCore.Mvc;
using HastaneRandevu.Models;

namespace HastaneRandevu.Controllers
{
	public class ClinicController : Controller
	{
		private readonly HospitalContext _context;

		// Veritabanı bağlantısını Constructor (Yapıcı Metot) ile alıyoruz
		public ClinicController(HospitalContext context)
		{
			_context = context;
		}

		// Klinik Listesini getiren ana sayfa
		public IActionResult Index()
		{
			var clinics = _context.Clinics.ToList();
			return View(clinics);
		}
		// Doktor Seçimi (Seçilen kliniğe göre filtreler)
		public IActionResult Doctors(int clinicId)
		{
			// Kliniğe ait doktorları veritabanından çekiyoruz
			var doctors = _context.Doctors
				.Include(d => d.Clinic) // Klinik adını da sayfada göstermek için dahil ediyoruz
				.Where(d => d.ClinicID == clinicId)
				.ToList();

			if (doctors.Count == 0)
			{
				// Eğer o klinikte doktor yoksa uyarı verebiliriz (şimdilik boş liste döner)
			}

			return View(doctors);
		}
	}
}