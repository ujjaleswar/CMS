 {{-- Footer --}}
 <footer class="text-light pt-4 pb-2 " style="background-color: rgb(16, 112, 177);">
     <div class="container">
         <div class="row">
             <div class="col-md-4 mb-4">
                 <h5 class="fw-bold">College Management</h5>
                 <p>CMS is your all-in-one platform for managing academic and administrative tasks efficiently and
                     effortlessly.</p>
             </div>
             <div class="col-md-4 mb-4">
                 <h5 class="fw-bold">Quick Links</h5>
                 <ul class="list-unstyled">
                     <li><a href="{{ route('landingpage') }}" class="text-white text-decoration-none">Home</a></li>
                     <li><a href="{{ route('contact.show') }}" class="text-white text-decoration-none">Contact
                             Us</a></li>
                     <li><a href="{{ route('about-us') }}" class="text-white text-decoration-none">About Us</a></li>
                     <li><a href="{{ route('achivement') }}" class="text-white text-decoration-none">Achievements</a>
                     </li>
                 </ul>
             </div>
             <div class="col-md-4 mb-4">
                 <h5 class="fw-bold">Contact</h5>
                 <p>Email: usenboult542@gmail.com</p>
                 <p>Phone: +91 98765 43210</p>
                 <p>Address: 123 College Road, Bhubaneswar, Odisha</p>
             </div>
         </div>

         <hr class="border-secondary">
         <div class="d-flex justify-content-between align-items-center">
             <small>&copy; {{ date('Y') }} College Management System. All rights reserved.</small>
             <p class="text-light mb-0">Developed by Ujjaleswar</p>
         </div>

     </div>
 </footer>
