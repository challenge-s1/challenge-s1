<script>
    import axios from 'axios';
    import { onMounted } from 'vue';

    console.log('ok');
    // onMounted(() => {
    //     console.log
    //     // axios.get('http://localhost:3000/api/masterClass')
    //     //     .then((response) => {
    //     //         console.log(response.data);
    //     //     })
    //     //     .catch((error) => {
    //     //         console.log(error);
    //     //     });
    // });



</script>
<template>
    <div class="relative bg-white w-[1750px] h-[2277px]">
      <div class="absolute left-0 top-0 inline-flex flex-col items-center w-[1750px] bg-[rgba(240,134,50,1)]">
        <!-- <div class="bg-white flex items-start text-left pl-[171px] pr-[171px]">
          <div class="relative w-[1170px] h-[102px]">
            <div class="[background:url(https://uortjlczjmucmpaqqhqm.supabase.co/storage/v1/object/public/firejet-converted-images/images/d7529c7da26f3c1302357b600fcaeb45dfd7274d:0.webp)_no-repeat_center_/_contain] absolute w-[120px] h-[52px] left-[525px] top-[calc(50%_-_26px_+_0px)]"/>
            <div class="absolute top-0 inline-flex items-start pt-[38px] pb-[37px] left-[15px] gap-[651.16px]">
              <div class="flex items-start font-normal w-[232.59375px] gap-[34.2px]">
                <div class="relative w-[48.94px] h-[25px]">
                  <div class="font-Montserrat text-[rgba(17,17,17,1)]">
                    <p class="left-0 absolute text-sm m-0 top-[3px] leading-[18px]">
                      USD
                    </p>
                  </div>
                  <div class="font-['Inter'] text-[rgba(136,136,136,1)]">
                    <div
                      class="absolute top-1 flex items-start pr-[5px] left-[34.94px]"
                    >
                      <p class="text-sm m-0 leading-[14px]">3</p>
                    </div>
                  </div>
                  <div
                    class="font-Montserrat text-[rgba(187,187,187,1)]"
                  >
                    <p
                      class="top-px absolute text-sm m-0 left-[63.81px] leading-[21px] w-[5px]"
                    >
                      <br />
                    </p>
                  </div>
                </div>
                <div class="relative w-[49.25px] h-[25px]">
                  <div
                    class="font-['Montserrat'] text-[rgba(17,17,17,1)]"
                  >
                    <p
                      class="left-0 absolute text-sm m-0 top-[3px] leading-[18px]"
                    >
                      ENG
                    </p>
                  </div>
                  <div class="font-Inter text-[rgba(136,136,136,1)]">
                    <div
                      class="absolute top-1 flex items-start pr-[5px] left-[35.25px]"
                    >
                      <p class="text-sm m-0 leading-[14px]">3</p>
                    </div>
                  </div>
                  <div
                    class="font-Montserrat text-[rgba(187,187,187,1)]"
                  >
                    <p
                      class="top-px absolute text-sm m-0 left-[64.13px] leading-[21px] w-[5px]"
                    >
                      <br />
                    </p>
                  </div>
                </div>
                <div class="relative w-[66px] h-[25px]">
                  <p
                    class="left-0 absolute text-sm inline m-0 top-[3px] font-['Montserrat'] leading-[18px] text-[rgba(17,17,17,1)]"
                  >
                    Sign in
                  </p>
                  <div
                    class="absolute top-1 inline-flex items-start pr-[5px] left-[52px] font-['Inter'] text-[rgba(136,136,136,1)]"
                  >
                    <p class="text-sm m-0 leading-[14px]">3</p>
                  </div>
                </div>
              </div>
              <div class="relative w-[256.25px] h-[27px] font-['Montserrat']">
                <div class="absolute left-0 font-normal w-[110.2px] h-[25.36px] top-[0.64px] text-[rgba(186,186,186,1)]">
                  <div class="w-6 absolute left-0 top-0 h-[25.36px]">
                    <div>
                      <div
                        class="[background:url(https://uortjlczjmucmpaqqhqm.supabase.co/storage/v1/object/public/firejet-converted-images/images/1db37ef373173e185a9b67e8d5aca3e66769d539:0.webp)_no-repeat_center_/_contain] w-6 left-0 absolute h-[25px] top-[calc(50%_-_12.5px_+_0.18px)]"
                       />
                    </div>
                    <div>
                      <p class="h-6 top-0 absolute text-base leading-6 m-0 w-[4.918749809265137px] left-[51.28px]">
                        <br />
                      </p>
                    </div>
                  </div>
                  <div
                    class="[background:url(https://uortjlczjmucmpaqqhqm.supabase.co/storage/v1/object/public/firejet-converted-images/images/eda2a5de4fb2d7308cc9a9ea6dcc7a6154eb93bc:0.webp)_no-repeat_center_/_contain] absolute w-[26px] h-[23px] left-[84.2px] top-[calc(50%_-_11.5px_+_0.18px)]"
                   />
                </div>
                <div
                  class="absolute top-0 font-semibold w-[116.84px] h-[27px] left-[139.41px]"
                >
                  <div class="text-[rgba(17,17,17,1)]">
                    <div class="absolute left-0 top-0 w-[23px] h-[27px]">
                      <div class="[background:url(https://uortjlczjmucmpaqqhqm.supabase.co/storage/v1/object/public/firejet-converted-images/images/917ed64323d2239e1e2db33830e46fd68d3f3244:0.webp)_no-repeat_center_/_contain] left-0 absolute w-[23px] h-[27px] top-[calc(50%_-_13.5px_+_0px)]"/>
                      <p class="absolute inline m-0 h-[19px] w-[10.31px] left-[7px] top-[5px] right-[5.69px] bottom-[3px] text-[15px] leading-[22.5px]">
                        0
                      </p>
                    </div>
                  </div>
                  <div>
                    <div
                      class="absolute leading-none inline-block left-[33.2px] top-[6.64px] w-[84px]"
                    >
                      <p
                        class="inline m-0 text-[15px] leading-[19px] text-[rgba(136,136,136,1)]"
                      >
                        {"Cart: "}
                      </p>
                      <p
                        class="inline m-0 text-[15px] leading-[19px] text-[rgba(17,17,17,1)]"
                      >
                        $0.00
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div> -->
        <!-- <div class="relative text-white text-center font-semibold w-[1140px] h-[62px] font-['Montserrat']">
          <p class="absolute text-base inline m-0 top-[22px] left-[calc(50%_-_27px_+_-309.2px)] tracking-[1px] leading-[19px]">
            Home
          </p>
          <p class="absolute text-base inline m-0 top-[22px] left-[calc(50%_-_27.5px_+_-184.39px)] tracking-[1px] leading-[19px]">
            About
          </p>
          <div class="absolute top-0 inline-flex items-start pl-[35px] pr-[35px] pt-[22px] pb-[21px] left-[447.28px] bg-[rgba(17,17,17,1)]">
            <p class="text-base m-0 tracking-[1px] leading-[19px]">
              Shop
            </p>
          </div>
          <p class="absolute text-base inline m-0 top-[22px] left-[calc(50%_-_27.5px_+_55.33px)] tracking-[1px] leading-[19px]">
            Pages
          </p>
          <p class="absolute text-base inline m-0 top-[22px] left-[calc(50%_-_21px_+_173.44px)] tracking-[1px] leading-[19px]">
            Blog
          </p>
          <p class="absolute text-base inline m-0 top-[22px] left-[calc(50%_-_36px_+_299.88px)] tracking-[1px] leading-[19px]">
            Contact
          </p>
        </div> -->
      </div>
      <!-- <div class="absolute top-56 font-normal w-[1170px] h-[60px] left-[171px]">
        <div class="text-black text-left font-['Playfair_Display']">
          <p class="-top-1 absolute italic m-0 left-[15px] text-[50px] leading-[67px] h-[67px]">
            Shop
          </p>
        </div>
        <div class="text-right font-['Montserrat']">
          <div class="absolute top-0 w-[555px] h-[39px] left-[600px]">
            <p class="absolute text-base inline m-0 top-[17px] right-[0.55px] leading-[19px] text-[rgba(136,136,136,1)]">
              Shop
            </p>
            <div class="absolute leading-none inline-block left-[439.56px] top-[15px]">
              <p class="text-base leading-6 inline m-0 text-[rgba(17,17,17,1)]">
                {"Home "}
              </p>
              <p class="text-base leading-6 inline m-0 text-[rgba(136,136,136,1)]">
                <br />
              </p>
            </div>
          </div>
        </div>
      </div> -->
      <div class="absolute w-[1170px] h-[1366.56px] mt-20 ml-40">
        <div class="absolute left-0 top-0 inline-flex items-start text-black font-normal pl-[15px] pr-[15px] gap-[30px]">
          <div class="[box-shadow:0px_0px_0px_1px_rgba(225,_225,_225,_1)_inset] [box-shadow-width:1px] relative w-[652.5px] h-[46px]">
            <div class="inset-y-px absolute right-px bg-white text-left left-[163.63px] font-['Montserrat']">
              <div class="absolute flex items-start pr-[401px] left-[30px] top-[12.5px] overflow-clip">
                <p class="text-base m-0 leading-[19px]">Search</p>
              </div>
            </div>
            <div class="h-11 absolute left-px top-px text-left right-[488.88px] font-['Montserrat']">
              <p class="top-3 absolute text-base inline m-0 h-[19px] w-[85.95px] left-[30px] leading-[44px]">
                Categories
              </p>
              <div class="w-px h-5 top-3 absolute left-[161.63px] bg-[rgba(225,225,225,1)]"/>
              <div class="[rotate:45deg] origin-top-left absolute w-[7px] h-[7px] left-[134.25px] top-[15.09px]"/>
            </div>
            <div class="absolute top-3.5 text-center left-[calc(50%_-_8px_+_302.39px)] font-['Inter']">
              <p class="text-base leading-4 m-0"></p>
            </div>
          </div>
          <div class="relative w-[457.5px] h-[46px]">
            <div class="absolute text-right top-[13px] right-[27.64px] font-['Inter']">
              <p class="text-lg m-0 leading-[18px]"></p>
            </div>
            <div class="absolute right-0 inline-flex items-start text-right top-[13px] font-['Inter']">
              <p class="text-lg m-0 leading-[18px]"></p>
            </div>
            <div class="absolute top-0 text-left w-[205px] h-[46px] right-[75.84px] bg-[rgba(245,245,245,1)] font-['Montserrat']">
              <p
                class="absolute text-base inline m-0 h-[19px] w-[120.64px] left-[30px] top-[13px] leading-[46px]"
              >
                Default sorting
              </p>
              <div
                class="[rotate:45deg] origin-top-left absolute w-[7px] h-[7px] left-[176.62px] top-[16.09px]"
               />
            </div>
          </div>
        </div>
        <div class="absolute left-0 top-24 text-center w-[1170px] h-[1227.56px] font-['Montserrat'] text-[rgba(17,17,17,1)]">
          <div class="absolute top-0 inline-flex flex-col items-start left-[15px]">
            <div class="[background:url(https://uortjlczjmucmpaqqhqm.supabase.co/storage/v1/object/public/firejet-converted-images/images/4b9a257c46e54ece60b0a4fa0632ad4d41a8998f:0.webp)_no-repeat_center_/_contain] relative font-normal w-[262.5px] h-[270px]">
              <div>
                <div class="pb-1.5 pr-2.5 absolute bg-white flex items-start rounded-sm pt-[7px] pl-[9px] top-[254px] left-[calc(50%_-_40.72px_+_0px)] drop-shadow-lg h-[31px]">
                  <p class="text-sm m-0 leading-[18px]">Cupcake</p>
                </div>
              </div>
            </div>
            <div class="relative font-semibold w-[262.5px] h-[99.19px]">
              <p class="top-10 absolute text-base uppercase inline m-0 left-[calc(50%_-_78.5px_+_0.02px)] leading-[19px]">
                Dozen Cupcakes
              </p>
              <p class="absolute text-base inline m-0 top-[77.19px] left-[calc(50%_-_27px_+_0.03px)] leading-[19px]"
        >
                $32.00
              </p>
            </div>
          </div>
          <div class="absolute top-0 inline-flex flex-col items-start left-[307.5px]">
            <div
              class="[background:url(https://uortjlczjmucmpaqqhqm.supabase.co/storage/v1/object/public/firejet-converted-images/images/07cbd67cc89a1f2e4d5aa165d62d2dc95d7c7303:0.webp)_no-repeat_center_/_contain] relative font-normal w-[262.5px] h-[270px]"
            >
              <div>
                <div
                  class="pb-1.5 pr-2.5 absolute bg-white flex items-start rounded-sm pt-[7px] pl-[9px] top-[254px] left-[calc(50%_-_40.72px_+_0px)] drop-shadow-lg h-[31px]"
                >
                  <p class="text-sm m-0 leading-[18px]">Cupcake</p>
                </div>
              </div>
            </div>
            <div class="relative font-semibold w-[262.5px] h-[99.19px]">
              <p
                class="top-10 absolute text-base uppercase inline m-0 left-[calc(50%_-_92.5px_+_0.39px)] leading-[19px]"
              >
                Cookies and Cream
              </p>
              <p
                class="absolute text-base inline m-0 top-[77.19px] left-[calc(50%_-_28px_+_-0.56px)] leading-[19px]"
              >
                $30.00
              </p>
            </div>
          </div>
          <div
            class="absolute top-0 inline-flex flex-col items-start left-[600px]"
          >
            <div
              class="[background:url(https://uortjlczjmucmpaqqhqm.supabase.co/storage/v1/object/public/firejet-converted-images/images/5f1d018619a04bdf0164df8aa74f3478127ace7d:0.webp)_no-repeat_center_/_contain] relative font-normal w-[262.5px] h-[270px]"
            >
              <div>
                <div
                  class="pb-1.5 pr-2.5 absolute bg-white flex items-start rounded-sm pt-[7px] pl-[9px] top-[254px] left-[calc(50%_-_40.72px_+_0px)] drop-shadow-lg h-[31px]"
                >
                  <p class="text-sm m-0 leading-[18px]">Cupcake</p>
                </div>
              </div>
            </div>
            <div class="relative font-semibold w-[262.5px] h-[99.19px]">
              <p
                class="top-10 absolute text-base uppercase inline m-0 left-[calc(50%_-_112px_+_-0.7px)] leading-[19px]"
              >
                Gluten Free Mini Dozen
              </p>
              <p
                class="absolute text-base inline m-0 top-[77.19px] left-[calc(50%_-_25.5px_+_0.17px)] leading-[19px]"
              >
                $31.00
              </p>
            </div>
          </div>
          <div
            class="absolute top-0 inline-flex flex-col items-start left-[892.5px]"
          >
            <div
              class="[background:url(https://uortjlczjmucmpaqqhqm.supabase.co/storage/v1/object/public/firejet-converted-images/images/e2c2b8a72236fea108e029b6cf418514e2cf1460:0.webp)_no-repeat_center_/_contain] relative font-normal w-[262.5px] h-[270px]"
            >
              <div>
                <div
                  class="pb-1.5 pr-2.5 absolute bg-white flex items-start rounded-sm pt-[7px] pl-[9px] top-[254px] left-[calc(50%_-_40.72px_+_0px)] drop-shadow-lg h-[31px]"
                >
                  <p class="text-sm m-0 leading-[18px]">Cupcake</p>
                </div>
              </div>
            </div>
            <div class="relative font-semibold w-[262.5px] h-[99.19px]">
              <p
                class="top-10 absolute text-base uppercase inline m-0 left-[calc(50%_-_67.5px_+_0.06px)] leading-[19px]"
              >
                Cookie Dough
              </p>
              <p
                class="absolute text-base inline m-0 top-[77.19px] left-[calc(50%_-_27px_+_0.02px)] leading-[19px]"
              >
                $25.00
              </p>
            </div>
          </div>
          <div
            class="absolute inline-flex flex-col items-start left-[15px] top-[409.19px]"
          >
            <div
              class="[background:url(https://uortjlczjmucmpaqqhqm.supabase.co/storage/v1/object/public/firejet-converted-images/images/e805a46a2dd4233fd9f5c5bb990fb1e512dd3b09:0.webp)_no-repeat_center_/_contain] relative font-normal w-[262.5px] h-[270px]"
            >
              <div>
                <div
                  class="pb-1.5 pr-2.5 absolute bg-white flex items-start rounded-sm pt-[7px] pl-[9px] top-[254px] left-[calc(50%_-_40.72px_+_0px)] drop-shadow-lg h-[31px]"
                >
                  <p class="text-sm m-0 leading-[18px]">Cupcake</p>
                </div>
              </div>
            </div>
            <div class="relative font-semibold w-[262.5px] h-[99.19px]">
              <p
                class="top-10 absolute text-base uppercase inline m-0 left-[calc(50%_-_114px_+_0.03px)] leading-[19px]"
              >
                Vanilla Salted Caramel
              </p>
              <p
                class="absolute text-base inline m-0 top-[77.19px] left-[calc(50%_-_28px_+_-0.72px)] leading-[19px]"
              >
                $05.00
              </p>
            </div>
          </div>
          <div
            class="absolute inline-flex flex-col items-start left-[307.5px] top-[409.19px]"
          >
            <div
              class="[background:url(https://uortjlczjmucmpaqqhqm.supabase.co/storage/v1/object/public/firejet-converted-images/images/ff6667e0ec2fd9788d8dbe82b564eb51033edeac:0.webp)_no-repeat_center_/_contain] relative font-normal w-[262.5px] h-[270px]"
            >
              <div>
                <div
                  class="pb-1.5 pr-2.5 absolute bg-white flex items-start rounded-sm pt-[7px] pl-[9px] top-[254px] left-[calc(50%_-_40.72px_+_0px)] drop-shadow-lg h-[31px]"
                >
                  <p class="text-sm m-0 leading-[18px]">Cupcake</p>
                </div>
              </div>
            </div>
            <div class="relative font-semibold w-[262.5px] h-[99.19px]">
              <p
                class="top-10 absolute text-base uppercase inline m-0 left-[calc(50%_-_92px_+_-0.86px)] leading-[19px]"
              >
                German Chocolate
              </p>
              <p
                class="absolute text-base inline m-0 top-[77.19px] left-[calc(50%_-_26.5px_+_0.28px)] leading-[19px]"
              >
                $14.00
              </p>
            </div>
          </div>
          <div
            class="absolute inline-flex flex-col items-start left-[600px] top-[409.19px]"
          >
            <div
              class="[background:url(https://uortjlczjmucmpaqqhqm.supabase.co/storage/v1/object/public/firejet-converted-images/images/a400a1308a9b36fa507ab2288b53e7a66bea214e:0.webp)_no-repeat_center_/_contain] relative font-normal w-[262.5px] h-[270px]"
            >
              <div>
                <div
                  class="pb-1.5 pr-2.5 absolute bg-white flex items-start rounded-sm pt-[7px] pl-[9px] top-[254px] left-[calc(50%_-_40.72px_+_0px)] drop-shadow-lg h-[31px]"
                >
                  <p class="text-sm m-0 leading-[18px]">Cupcake</p>
                </div>
              </div>
            </div>
            <div class="relative font-semibold w-[262.5px] h-[99.19px]">
              <p
                class="top-10 absolute text-base uppercase inline m-0 left-[calc(50%_-_73px_+_0.02px)] leading-[19px]"
              >
                Dulce De Leche
              </p>
              <p
                class="absolute text-base inline m-0 top-[77.19px] left-[calc(50%_-_27px_+_0.03px)] leading-[19px]"
              >
                $32.00
              </p>
            </div>
          </div>
          <div
            class="absolute inline-flex flex-col items-start left-[892.5px] top-[409.19px]"
          >
            <div
              class="[background:url(https://uortjlczjmucmpaqqhqm.supabase.co/storage/v1/object/public/firejet-converted-images/images/51b556e12cf45b49226337e0af4cb80eb091d1a5:0.webp)_no-repeat_center_/_contain] relative font-normal w-[262.5px] h-[270px]"
            >
              <div>
                <div
                  class="pb-1.5 pr-2.5 absolute bg-white flex items-start rounded-sm pt-[7px] pl-[9px] top-[254px] left-[calc(50%_-_40.72px_+_0px)] drop-shadow-lg h-[31px]"
                >
                  <p class="text-sm m-0 leading-[18px]">Cupcake</p>
                </div>
              </div>
            </div>
            <div class="relative font-semibold w-[262.5px] h-[99.19px]">
              <p
                class="top-10 absolute text-base uppercase inline m-0 left-[calc(50%_-_72.5px_+_0.3px)] leading-[19px]"
              >
                Mississippi Mud
              </p>
              <p
                class="absolute text-base inline m-0 top-[77.19px] left-[calc(50%_-_28.5px_+_0.16px)] leading-[19px]"
              >
                $08.00
              </p>
            </div>
          </div>
          <div
            class="absolute inline-flex flex-col items-start left-[15px] top-[818.38px]"
          >
            <div
              class="[background:url(https://uortjlczjmucmpaqqhqm.supabase.co/storage/v1/object/public/firejet-converted-images/images/a38a17f9260e0d77232250786f08392d1e70b22e:0.webp)_no-repeat_center_/_contain] relative font-normal w-[262.5px] h-[270px]"
            >
              <div>
                <div
                  class="pb-1.5 pr-2.5 absolute bg-white flex items-start rounded-sm pt-[7px] pl-[9px] top-[254px] left-[calc(50%_-_40.72px_+_0px)] drop-shadow-lg h-[31px]"
                >
                  <p class="text-sm m-0 leading-[18px]">Cupcake</p>
                </div>
              </div>
            </div>
            <div class="relative font-semibold w-[262.5px] h-[99.19px]">
              <p
                class="top-10 absolute text-base uppercase inline m-0 left-[calc(50%_-_90.5px_+_0.34px)] leading-[19px]"
              >
                VEGAN/GLUTEN FREE
              </p>
              <p
                class="absolute text-base inline m-0 top-[77.19px] left-[calc(50%_-_27.5px_+_0.31px)] leading-[19px]"
              >
                $98.85
              </p>
            </div>
          </div>
          <div
            class="absolute inline-flex flex-col items-start left-[307.5px] top-[818.38px]"
          >
            <div
              class="[background:url(https://uortjlczjmucmpaqqhqm.supabase.co/storage/v1/object/public/firejet-converted-images/images/cf4f5e47b082cf29f9f0283a590c081052890005:0.webp)_no-repeat_center_/_contain] relative font-normal w-[262.5px] h-[270px]"
            >
              <div>
                <div
                  class="pb-1.5 pr-2.5 absolute bg-white flex items-start rounded-sm pt-[7px] pl-[9px] top-[254px] left-[calc(50%_-_40.72px_+_0px)] drop-shadow-lg h-[31px]"
                >
                  <p class="text-sm m-0 leading-[18px]">Cupcake</p>
                </div>
              </div>
            </div>
            <div class="relative font-semibold w-[262.5px] h-[99.19px]">
              <p
                class="top-10 absolute text-base uppercase inline m-0 left-[calc(50%_-_65.5px_+_0.03px)] leading-[19px]"
              >
                SWEET CELTICS
              </p>
              <p
                class="absolute text-base inline m-0 top-[77.19px] left-[calc(50%_-_21.5px_+_0.22px)] leading-[19px]"
              >
                $5.77
              </p>
            </div>
          </div>
          <div
            class="absolute inline-flex flex-col items-start left-[600px] top-[818.38px]"
          >
            <div
              class="[background:url(https://uortjlczjmucmpaqqhqm.supabase.co/storage/v1/object/public/firejet-converted-images/images/e7d3468f84c843a88b016ea5337c83f3b43e7eab:0.webp)_no-repeat_center_/_contain] relative font-normal w-[262.5px] h-[270px]"
            >
              <div>
                <div
                  class="pb-1.5 pr-2.5 absolute bg-white flex items-start rounded-sm pt-[7px] pl-[9px] top-[254px] left-[calc(50%_-_40.72px_+_0px)] drop-shadow-lg h-[31px]"
                >
                  <p class="text-sm m-0 leading-[18px]">Cupcake</p>
                </div>
              </div>
            </div>
            <div class="relative font-semibold w-[262.5px] h-[99.19px]">
              <p
                class="top-10 absolute text-base uppercase inline m-0 left-[calc(50%_-_103.5px_+_0.3px)] leading-[19px]"
              >
                SWEET AUTUMN LEAVES
              </p>
              <p
                class="absolute text-base inline m-0 top-[77.19px] left-[calc(50%_-_25px_+_0.02px)] leading-[19px]"
              >
                $26.41
              </p>
            </div>
          </div>
          <div
            class="absolute inline-flex flex-col items-start left-[892.5px] top-[818.38px]"
          >
            <div
              class="[background:url(https://uortjlczjmucmpaqqhqm.supabase.co/storage/v1/object/public/firejet-converted-images/images/a801d4cacddf1efa4129b250ec2f2c2e76b8a49b:0.webp)_no-repeat_center_/_contain] relative font-normal w-[262.5px] h-[270px]"
            >
              <div>
                <div
                  class="pb-1.5 pr-2.5 absolute bg-white flex items-start rounded-sm pt-[7px] pl-[9px] top-[254px] left-[calc(50%_-_40.72px_+_0px)] drop-shadow-lg h-[31px]"
                >
                  <p class="text-sm m-0 leading-[18px]">Cupcake</p>
                </div>
              </div>
            </div>
            <div class="relative font-semibold w-[262.5px] h-[99.19px]">
              <p
                class="top-10 absolute text-base uppercase inline m-0 left-[calc(50%_-_91.5px_+_0.13px)] leading-[19px]"
              >
                PALE YELLOW SWEET
              </p>
              <p
                class="absolute text-base inline m-0 top-[77.19px] left-[calc(50%_-_26.5px_+_0.22px)] leading-[19px]"
              >
                $22.47
              </p>
            </div>
          </div>
        </div>
        <div class="absolute left-0 w-[1170px] h-[43px] top-[1323.56px]">
          <div
            class="h-10 absolute top-0 text-black text-center font-semibold w-[555px] left-[15px]"
          >
            <p
              class="absolute text-lg inline m-0 top-[9px] left-[calc(50%_-_3.5px_+_-257.44px)] font-['Montserrat'] leading-[22px]"
            >
              1
            </p>
            <p
              class="absolute text-lg inline m-0 top-[9px] left-[calc(50%_-_5.5px_+_-213.05px)] font-['Montserrat'] leading-[22px]"
            >
              2
            </p>
            <p
              class="absolute text-lg inline m-0 top-[9px] left-[calc(50%_-_5.5px_+_-168.84px)] font-['Montserrat'] leading-[22px]"
            >
              3
            </p>
            <div
              class="absolute inline-flex items-start pl-[3px] pr-[3px] top-[11px] left-[calc(50%_-_9px_+_-124.89px)] font-['Inter']"
            >
              <p class="text-lg m-0 leading-[18px]">5</p>
            </div>
          </div>
          <p
            class="top-1 absolute text-base font-normal text-right inline m-0 right-[14.91px] font-['Montserrat'] leading-[19px] text-[rgba(17,17,17,1)]"
          >
            Showing 1-9 of 10 results
          </p>
        </div>
      </div>
      <div
        class="[background:url(https://uortjlczjmucmpaqqhqm.supabase.co/storage/v1/object/public/firejet-converted-images/images/1a2e1da1a6034545c33200fbde0ce05c8cf0b2a5:0.webp)_no-repeat_center_/_contain] absolute left-0 gap-10 inline-flex flex-col items-center w-[1750px] pt-[70px] pb-[11px] top-[1831px]"
      >
        <div
          class="flex items-start pl-[15px] pr-[15px] pb-[30px] gap-[30px]"
        >
          <div
            class="relative flex flex-col items-start text-left w-[360px] gap-[22.19px] font-['Montserrat']"
          >
            <div class="text-white font-semibold">
              <p class="relative text-base uppercase m-0 leading-[19px]">
                WORKING HOURS
              </p>
            </div>
            <div class="font-normal text-[rgba(164,164,164,1)]">
              <div
                class="relative flex flex-col items-start pt-[9px] pb-[9px] pr-[93px] gap-[18px]"
              >
                <p class="text-sm m-0 leading-[18px]">
                  Monday - Friday: 08:00 am – 08:30 pm
                </p>
                <p class="text-sm m-0 leading-[18px]">
                  Saturday: 10:00 am – 16:30 pm
                </p>
                <p class="text-sm m-0 leading-[18px]">
                  Sunday: 10:00 am – 16:30 pm
                </p>
              </div>
            </div>
            <div>
              <div
                class="w-px top-0 absolute h-[165px] left-[334px] bg-[rgba(255,255,255,0.1)]"
               />
            </div>
          </div>
          <div
            class="relative text-center font-normal w-[360px] h-[232px]"
          >
            <div>
              <div
                class="[background:url(https://uortjlczjmucmpaqqhqm.supabase.co/storage/v1/object/public/firejet-converted-images/images/9f579081cd39a240b931e0e7b6377a77c89f3d55:0.webp)_no-repeat_center_/_contain] absolute w-[120px] h-[52px] left-[calc(50%_-_60px_+_0px)] top-[calc(50%_-_26px_+_-90px)]"
               />
            </div>
            <div class="font-['Montserrat'] text-[rgba(164,164,164,1)]">
              <p
                class="absolute text-sm m-0 h-[70px] w-[341.39px] top-[88px] left-[calc(50%_-_170.69px_+_0.1px)] leading-[26px]"
              >
                Lorem ipsum dolor amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore dolore magna aliqua.
              </p>
            </div>
            <div class="text-white font-['Inter']">
              <div
                class="absolute left-0 flex items-start pl-[75px] pr-[75px] top-[187px] gap-[10.2px]"
              >
                <div
                  class="relative w-[45px] h-[45px] bg-[rgba(225,225,225,0.1)] rounded-[22.5px]"
                >
                  <div
                    class="absolute top-3.5 left-[calc(50%_-_8px_+_-0.58px)]"
                  >
                    <p class="text-base leading-4 m-0"></p>
                  </div>
                </div>
                <div
                  class="relative w-[45px] h-[45px] bg-[rgba(225,225,225,0.1)] rounded-[22.5px]"
                >
                  <div
                    class="absolute top-3.5 left-[calc(50%_-_8px_+_-0.44px)]"
                  >
                    <p class="text-base leading-4 m-0"></p>
                  </div>
                </div>
                <div
                  class="relative w-[45px] h-[45px] bg-[rgba(225,225,225,0.1)] rounded-[22.5px]"
                >
                  <div
                    class="absolute top-3.5 left-[calc(50%_-_8px_+_-0.86px)]"
                  >
                    <p class="text-base leading-4 m-0"></p>
                  </div>
                </div>
                <div
                  class="relative w-[45px] h-[45px] bg-[rgba(225,225,225,0.1)] rounded-[22.5px]"
                >
                  <div
                    class="absolute top-3.5 left-[calc(50%_-_8px_+_0px)]"
                  >
                    <p class="text-base leading-4 m-0"></p>
                  </div>
                </div>
              </div>
            </div>
            <div>
              <div
                class="w-px top-0 absolute h-[165px] left-[394px] bg-[rgba(255,255,255,0.1)]"
               />
            </div>
          </div>
          <div class="relative w-[360px] h-[142.19px]">
            <p
              class="top-0 absolute text-base font-semibold text-left text-white uppercase inline m-0 left-[50px] font-['Montserrat'] leading-[19px]"
            >
              Subscribe
            </p>
            <p
              class="absolute text-sm font-normal text-left inline m-0 left-[50px] top-[45.19px] font-['Montserrat'] leading-[18px] text-[rgba(164,164,164,1)]"
            >
              Get latest updates and offers.
            </p>
            <div
              class="absolute font-normal w-[310px] h-[50px] left-[50px] top-[92.19px]"
            >
              <div
                class="inset-x-0 absolute top-0 text-white text-left h-[50px] bg-[rgba(253,243,234,0.2)] font-['Montserrat']"
              >
                <div
                  class="absolute top-4 flex items-start pr-[246px] left-[22px] overflow-clip"
                >
                  <p class="text-sm m-0 leading-[18px]">Email</p>
                </div>
              </div>
              <div
                class="absolute text-center top-[15px] left-[calc(50%_-_10px_+_125px)] font-['Inter'] text-[rgba(240,134,50,1)]"
              >
                <p class="text-xl leading-5 m-0"></p>
              </div>
            </div>
          </div>
        </div>
        <div
          class="pb-3.5 bg-black flex items-start font-normal pl-[171px] pr-[171px] pt-[18px]"
        >
          <div
            class="flex items-start pl-[15px] pr-[15px] w-[1170px] gap-[30px]"
          >
            <div class="h-7 relative text-left w-[652.5px]">
              <p
                class="left-0 absolute text-sm text-white inline m-0 top-[5px] font-['Montserrat'] leading-[18px]"
              >
                {"Copyright ©2023 All rights reserved "}
                <br />
                {" This template is made with"}
              </p>
              <div
                class="absolute left-[451.95px] top-[7px] font-['Inter'] text-[rgba(240,134,50,1)]"
              >
                <p class="text-sm m-0 leading-[14px]"></p>
              </div>
              <div
                class="absolute leading-none inline-block left-[465.95px] top-[5px] font-['Montserrat']"
              >
                <p class="text-sm text-white inline m-0 leading-[18px]">
                  {"by "}
                </p>
                <p
                  class="text-sm inline m-0 leading-[18px] text-[rgba(240,134,50,1)]"
                >
                  Colorlib
                </p>
              </div>
            </div>
            <div
              class="h-6 relative text-right w-[457.5px] font-['Montserrat'] text-[rgba(136,136,136,1)]"
            >
              <div
                class="absolute top-0 leading-none inline-block left-[106.45px]"
              >
                <p class="text-sm leading-6 inline m-0">
                  {"Privacy Policy "}
                </p>
                <p class="text-base leading-6 inline m-0">
                  <br />
                </p>
              </div>
              <div
                class="absolute top-0 leading-none inline-block left-[235.86px]"
              >
                <p class="text-sm leading-6 inline m-0">
                  {"Terms & Conditions "}
                </p>
                <p class="text-base leading-6 inline m-0">
                  <br />
                </p>
              </div>
              <p
                class="absolute text-sm inline m-0 top-[3px] right-[0.05px] leading-[18px]"
              >
                Site Map
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}

<!-- ThemewagonGithubIoByHtmlToDesignFreeVersion19012023174902Cet.defaultProps = {
  style: {},
};

interface ThemewagonGithubIoByHtmlToDesignFreeVersion19012023174902CetProps {
  style: Object;
}

/**
 * This component was generated from Figma with FireJet.
 * Learn more at https://www.firejet.io
 *
 * README:
 * The output code may look slightly different when copied to your codebase. To fix this:
 * 1. Include the necessary fonts. The required fonts are imported from public/index.html
 * 2. Include the global styles. They can be found in App.css
 *
 * Note: Step 2 is not required for tailwind.css output
 */ -->


</template>