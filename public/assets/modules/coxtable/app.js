
     angular.module('Coxmaker', []);

    angular.module('Coxmaker')
      .controller('TableController', tablo)
      .controller('OrtakController', ortak)
      .controller('IsController', is);
    
    function tablo() {
        this.name = "Project Name";
    }

    function ortak($scope) {
      var ortaklar = this;

      ortaklar.list = [
      { isim: "Ali" },
      { isim: "Fatih" },
      { isim: "Volkan" },
      { isim: "Furkan" }
      ];

      ortaklar.count = ortaklar.list.length;

      ortaklar.add = function() {
        ortaklar.list.push({isim:ortaklar.isim});
        ortaklar.isim = '';


      };

      ortaklar.destroy = function(index) {
        delete ortaklar.list.splice(index, 1);
      
      };


      $scope.totalUserCount = function(){

          var sayi = ortaklar.list.length;
          return sayi;

      };



    };


    function is($scope) {
      var is = this;

      is.list = [
      { adi: "Design" },
      { adi: "Frontend" },
      { adi: "Management" },
      { adi: "Backend" }
      ];

      is.add = function() {
        is.list.push({adi:is.adi});
        is.adi = '';
              $scope.columnCount();
      };

      is.count = is.list.length;

      is.destroy = function(index) {
        delete is.list.splice(index, 1);

      
      };

      $scope.totalCount = function(){

          var sayi = is.list.length;
          return sayi;

      };


      $scope.columnCount = function(){

        var uzunluk = is.list.length;
        var arr = [];
        var x = 0;

        for (var i = 0; i < uzunluk; i++) {
            arr.push(i);
            //Do something
        }
        return arr;

      };


    };
